<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItem::create([
            'service_id'    => 3,
            'order_id'      => 1,
            'number'        => 2,
        ]);

        OrderItem::create([
            'service_id'    => 4,
            'order_id'      => 1,
            'number'        => 2,
        ]);

        OrderItem::create([
            'service_id'    => 1,
            'order_id'      => 2,
            'number'        => 3,
        ]);


        OrderItem::create([
            'service_id'    => 5,
            'order_id'      => 2,
            'number'        => 1,
        ]);
    }
}
