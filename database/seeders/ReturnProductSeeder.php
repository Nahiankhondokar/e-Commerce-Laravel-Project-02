<?php

namespace Database\Seeders;

use App\Models\ReturnProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReturnProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = [
            [
                'id'            => 1, 
                'order_id'      => 1,
                'user_id'       => 1,
                'product_id'    => 1,
                'product_code'  => 'ASDG342',
                'product_size'  => 'small',
                'return_reason' => "Damage product"
            ],
            [
                'id'            => 2, 
                'order_id'      => 2,
                'user_id'       => 2,
                'product_id'    => 3,
                'product_code'  => 'AFDF234',
                'product_size'  => 'medium',
                'return_reason' => "Item Arrive Too Late"
            ]
        ];


        ReturnProduct::insert($record);
    }
}
