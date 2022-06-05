<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'user_id'   => 2,
            'title'     => 'home',
            'string'    => '385 J block Johar town lahore',
            'lat'       => 34.563433,
            'lang'      => 74.563433
        ]);
    }
}
