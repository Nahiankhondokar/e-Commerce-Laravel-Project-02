<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttrRecords = [
            [
                'id'        => 1, 
                'product_id'=> 2,
                'size'      => 'small',
                'price'      => 1000,
                'stock'      => 5,
                'sku'      => 'BTC001-S',
            ],
            [
                'id'        => 2, 
                'product_id'=> 2,
                'size'      => 'medium',
                'price'      => 1200,
                'stock'      => 15,
                'sku'       => 'BTC00-M',
            ],
            [
                'id'        => 3, 
                'product_id'=> 2,
                'size'      => 'large',
                'price'      => 1500,
                'stock'      => 10,
                'sku'      => 'BTC001-L',
            ],
        ];


        ProductAttribute::insert($productAttrRecords);
    }
}
