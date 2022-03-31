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
            'city'      => 'lahore',
            'area'      => 'johar town',
            'street'    => '385 J block Johar town lahore'
        ]);
    }
}
