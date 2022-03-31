<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) {
            Service::create([
                'sub_category_id' => 1,
                'name'            => 'service '.$i,
                'image'           => 'images/services/service.jpg',
                'rate'            => '5',
                'price_type'      => 'fixed',
                'orders'          => '12',
                'price'           => '120',
                'city'            => 'lahore'
            ]);

            Service::create([
                'sub_category_id' => 2,
                'name'            => 'service 1'.$i,
                'image'           => 'images/services/service.jpg',
                'rate'            => '5',
                'price_type'      => 'variable',
                'orders'          => '12',
                'price'           => '120',
                'city'            => 'lahore'
            ]);

            Service::create([
                'sub_category_id' => 3,
                'name'            => 'service 2'.$i,
                'image'           => 'images/services/service.jpg',
                'rate'            => '5',
                'price_type'      => 'fixed',
                'orders'          => '12',
                'price'           => '120',
                'city'            => 'lahore'
            ]);
        }
    }
}
