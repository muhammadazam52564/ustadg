<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

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
            'user_id' => 2,
            'date'     => '2022-03-31',
            'time'     => '11:32:12',
            'selected_address' =>1,
        ]);

        Order::create([
            'user_id'           => 2,
            'date'              => '2022-03-31',
            'time'              => '11:32:12',
            'selected_address'  =>1,
            'status'            => 'completed'
        ]);
    }
}
