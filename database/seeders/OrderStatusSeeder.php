<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
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
                'id'        => 1, 
                'name'      => 'New',
            ],
            [
                'id'        => 2, 
                'name'      => 'Pendding'
            ],
            [
                'id'        => 3, 
                'name'      => 'Hold'
            ],
            [
                'id'        => 4, 
                'name'      => 'Cancel'
            ],
            [
                'id'        => 5, 
                'name'      => 'Process'
            ],
            [
                'id'        => 6, 
                'name'      => 'Paid'
            ],
            [
                'id'        => 7, 
                'name'      => 'Shipped'
            ],
            [
                'id'        => 8, 
                'name'      => 'Delivered'
            ],

        ];


        OrderStatus::insert($record);
    }
}
