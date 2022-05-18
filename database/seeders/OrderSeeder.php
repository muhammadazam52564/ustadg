<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'ordernumber'       => IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' => 00]),
            'user_id'           => 2,
            'date'              => '2022-03-31',
            'time'              => '11:32:12',
            'selected_address'  =>1,
        ]);

        Order::create([
            'ordernumber'       => IdGenerator::generate(['table' => 'orders', 'length' => 9, 'prefix' => 00]),
            'user_id'           => 2,
            'date'              => '2022-03-31',
            'time'              => '11:32:12',
            'selected_address'  =>1,
            'status'            => 'completed'
        ]);
    }
}
