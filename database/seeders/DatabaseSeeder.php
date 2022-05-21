<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(UserSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(NotificationSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(SubCategorySeeder::class);
        // $this->call(ServiceSeeder::class);
        // $this->call(BannerSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(OrderItemSeeder::class);


    }
}
