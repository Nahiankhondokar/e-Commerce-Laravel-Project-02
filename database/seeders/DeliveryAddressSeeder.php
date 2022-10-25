<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Records = [
            [
                'id'        => 1, 
                'user_id'   => 2,
                'name'      => 'ibrahim'
            ],
            [
                'id'        => 2, 
                'user_id'   => 1,
                'name'      => 'farid'
            ]
        ];


        DeliveryAddress::insert($Records);
    }
}
