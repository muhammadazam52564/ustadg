<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name'  => 'lahore',
        ]);
        City::create([
            'name'  => 'islamabad',
        ]);
        City::create([
            'name'  => 'karachi',
        ]);
        City::create([
            'name'  => 'peshawar',
        ]);
        City::create([
            'name'  => 'quetta',
        ]);
    }
}