<?php

namespace Database\Seeders;

use App\Models\ExchangeProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeProductSeeder extends Seeder
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
                'product_code'  => 'ASDG342',
                'product_size'  => 'small',
                'required_size' => 'medium',
                'exchange_reason' => "Damage product"
            ],
            [
                'id'            => 2, 
                'order_id'      => 2,
                'user_id'       => 2,
                'product_code'  => 'AFDF234',
                'product_size'  => 'medium',
                'required_size' => 'large',
                'exchange_reason' => "Item Arrive Too Late"
            ]
        ];


        ExchangeProduct::insert($record);
    }
}
