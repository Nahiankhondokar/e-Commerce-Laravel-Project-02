<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rating = [
            [
                'id'                 => 1, 
                'user_id'            => 1,
                'product_id'         => 1,
                'review'             => 'good product',
                'rating'             => 4,
            ],
            [
                'id'                 => 2, 
                'user_id'            => 2,
                'product_id'         => 2,
                'review'             => 'normal product',
                'rating'             => 3,
            ],
            [
                'id'                 => 3, 
                'user_id'            => 4,
                'product_id'         => 5,
                'review'             => 'best product',
                'rating'             => 5,
            ],
        ];


        Rating::insert($rating);
    }
}
