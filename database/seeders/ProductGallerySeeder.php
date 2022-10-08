<?php

namespace Database\Seeders;

use App\Models\ProductGallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductGallery::insert([
            'id'                   => 1, 
            'product_id'            => 6,
            'images'                => '9589e7662f2dba0625344203b508b583.jpg'
        ]);
    }
}
