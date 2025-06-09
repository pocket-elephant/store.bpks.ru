<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Okei;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class RS24Sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rs24:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync stock from rs24';

    /**
     * Config
     *
     * @var array
     */
    protected array $config = [];

    /**
     * Stock storage
     *
     * @var Filesystem
     */
    protected Filesystem $storage;

    /**
     * Supplier
     *
     * @var Supplier
     */
    protected Supplier $supplier;

    /**
     * Boot
     *
     * @return void
     */
    protected function boot(): void
    {
        $this->config = config('suppliers.rs24');
        $this->storage = Storage::disk(
            $this->config['disk']
        );
    }

    /**
     * Get stock files list
     *
     * @return array
     */
    protected function stockFiles(): array
    {
        $this->comment("Get stock files list from directory:{$this->config['stockDirectory']}");

        return $this->storage->files(
            $this->config['stockDirectory']
        );
    }

    /**
     * Get last stock file
     *
     * @return string
     */
    protected function lastStockFile(): string
    {
        return collect(
            $this->stockFiles()
        )->sortDesc()->first();
    }

    protected function processDocDetail(SimpleXMLElement $docDetail)
    {
        $this->info("Process Product:{$docDetail->ProductName}");
        $price = (float)$docDetail->RetailPrice;
        $price += $price * 0.15;
        $this->comment($docDetail->RetailPrice . " -> " . $price);
        $this->comment($docDetail->SumQTY);

        $stock = (int) $docDetail->SumQTY;
        if($stock < 1) {
            return;
        }

        $categoryName = (string)$docDetail->ProductGroup;

        if ($categoryName) {
            $category = Category::firstOrCreate([
                'name' => $categoryName,
            ]);

            $okei = Okei::where('symbolInternationalView', 'like', "%{$docDetail->UOM}%")
                ->first();

            $product = Product::withTrashed()->updateOrCreate([
                'name' => (string)$docDetail->ProductName,
                'supplier_id' => $this->supplier->id,
            ], [
                'category_id' => $category->id,
                'price' => $price,
                'stock' => $stock,
                'okei_id' => $okei->id,
                'supplier_data' => (array) $docDetail,
                'processed' => true,
            ]);
        }

    }

    protected function processStockFile(string $stockFilePath)
    {
        $this->comment("Process file:{$stockFilePath}");

        $xml = simplexml_load_string(
            $this->storage->get($stockFilePath)
        );

        foreach ($xml->DocDetail as $docDetail) {
            $this->processDocDetail($docDetail);
        }
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->supplier = Supplier::firstWhere('key', 'rs24');

        if (!$this->supplier) {
            $this->error('Can`t find supplier');
            return static::FAILURE;
        }

        $this->info("Mark supplier products as unprocessed");

        $this->supplier->products()->update([
            'processed' => false,
        ]);

        $this->boot();

        $this->processStockFile(
            $this->lastStockFile()
        );

        $this->info("Delete supplier unprocessed products");

        $this->supplier->products()->where([
            'processed' => false,
        ])->delete();

        return static::SUCCESS;
    }
}
