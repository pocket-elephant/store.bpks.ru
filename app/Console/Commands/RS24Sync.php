<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Okei;
use App\Models\Product;
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
        $this->comment($docDetail->RetailPrice);
        $this->comment($docDetail->SumQTY);

        $categoryName = (string)$docDetail->ProductGroup;

        if ($categoryName) {
            $category = Category::firstOrCreate([
                'name' => $categoryName,
            ]);

            $okei = Okei::where('symbolInternationalView', 'like', "%{$docDetail->UOM}%")
                ->first();

            $product = Product::updateOrCreate([
                'name' => (string)$docDetail->ProductName,
            ], [
                'category_id' => $category->id,
                'price' => (float) $docDetail->RetailPrice,
                'okei_id' => $okei->id,
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
        $this->boot();

        $this->processStockFile(
            $this->lastStockFile()
        );

        return static::SUCCESS;
    }
}
