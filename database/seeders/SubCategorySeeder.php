<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            SubCategory::create([
                'category_id'   => 1,
                'name'          => 'subcategory '.$i,
                'image'         => 'images/subcategories/subcategory.jpg',
                'city'          => 'lahore'
            ]);

            SubCategory::create([
                'category_id'   => 2,
                'name'          => 'subcategory '.$i,
                'image'         => 'images/subcategories/subcategory.jpg',
                'city'          => 'lahore'
            ]);

            SubCategory::create([
                'category_id'   => 3,
                'name'          => 'subcategory '.$i,
                'image'         => 'images/subcategories/subcategory.jpg',
                'city'          => 'lahore'
            ]);

            SubCategory::create([
                'category_id'   => 4,
                'name'          => 'subcategory '.$i,
                'image'         => 'images/subcategories/subcategory.jpg',
                'city'          => 'lahore'
            ]);
        }
    }
}
