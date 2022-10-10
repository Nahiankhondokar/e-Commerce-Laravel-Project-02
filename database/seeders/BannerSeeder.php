<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
            [
                'id'            => 1, 
                'image'         => 'banner1.png'
            ],
            [
                'id'            => 2, 
                'image'         => 'banner2.png'
            ],
            [
                'id'            => 3, 
                'image'         => 'banner3.png'
            ]
        ];


        Banner::insert($banner);
    }
}
