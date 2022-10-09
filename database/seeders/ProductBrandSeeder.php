<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productbrandRecords = [
            [
                'id'        => 1, 
                'name'      => 'Apple'
            ],
            [
                'id'        => 2, 
                'name'      => 'Microsoft'
            ],
            [
                'id'        => 3, 
                'name'      => 'Tesla'
            ],
        ];


        ProductBrand::insert($productbrandRecords);
    }
}
