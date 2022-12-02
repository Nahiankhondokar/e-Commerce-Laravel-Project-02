<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
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
                'id'            => 1, 
                'user_id'       => 1,
                'product_id'    => 1
            ],
            [
                'id'        => 2, 
                'user_id'   => 1,
                'name'      => 2
            ]
        ];


        Wishlist::insert($Records);
    }
}
