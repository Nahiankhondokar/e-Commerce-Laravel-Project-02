<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            'id'                   => 1, 
            'product_name'        => 'Green Casual T-Shart',
            'category_id'          => 8,
            'section_id'           => 1,
            'product_code'         => 'P001',
            'product_color'         => 'green',
            'product_price'        => '1200',
            'is_featured'          => 'No'
        ]);
    }
}
