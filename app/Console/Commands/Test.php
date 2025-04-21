<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Order;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $order = Order::where('uuid', '019639cd-8579-70bb-ab4b-cb8646d55322')->first();
        dd(route('api.orders.show', $order));
        dd();
        $application = Application::create([
            'name' => '1С УПП',
        ]);

        /** @var Application $application */
        $application = Application::find(1);
        dd($application->createToken('api', ['orders:listOfNew', 'orders:show', 'orders:sync', 'orders:list'])->plainTextToken);

        /** @var Order $order */
        $order = Order::latest('id')
            ->first();

        dd(route('api.orders.show', $order));

        $order->applications()->syncWithoutDetaching([
            $application->id, [
                'external_id' => '123',
            ],
        ]);

        dd($application->orders()->toSql());
    }
}
