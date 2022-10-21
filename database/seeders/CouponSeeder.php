<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [
            [
                'id'                    => 1, 
                'coupon_option'         => 'Manual',
                'coupon_code'            => 'test10',
                'categories'             => '1',
                'users'                 => 'admin@gmail.com',
                'expire_date'            => '2022-11-25',
            ]
        ];


        Coupon::insert($couponRecords);
    }
}
