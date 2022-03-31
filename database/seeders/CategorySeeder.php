<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) {
            Category::create([
                'name'          => 'category '.$i,
                'name_urdu'     => 'قسم '.$i,
                'image'         => 'images/categories/category.jpg',
                'city'          => 'lahore'
            ]);

            Category::create([
                'name'          => 'category 2'.$i,
                'name_urdu'     => 'قسم 2'.$i,
                'image'         => 'images/categories/category.jpg',
                'city'          => 'lahore'
            ]);

            Category::create([
                'name'          => 'category 3'.$i,
                'name_urdu'     => 'قسم 3'.$i,
                'image'         => 'images/categories/category.jpg',
                'city'          => 'lahore'
            ]);
        }
    }
}
