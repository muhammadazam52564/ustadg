<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++)
        {
            Banner::create([
                'name'          => 'banner '.$i,
                'image'         => 'images/banners/banner.jpeg',
                'city'          => 'lahore',
                'category_id'   => 1
            ]);

            Banner::create([
                'name'          => 'banner 1'.$i,
                'image'         => 'images/banners/banner.jpeg',
                'city'          => 'lahore',
                'category_id'   => 2
            ]);

            Banner::create([
                'name'          => 'banner 2'.$i,
                'image'         => 'images/banners/banner.jpeg',
                'city'          => 'lahore',
                'category_id'   => 3
            ]);


        }
    }
}
