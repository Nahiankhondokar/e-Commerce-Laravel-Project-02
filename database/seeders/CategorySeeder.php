<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'id'                    => 1, 
                'category_name'         => 't-shart',
                'parent_id'             => 0,
                'section_id'             => 1,
                'category_image'         => '',
                'category_discount'      => 0,
                'description'            => '',
                'ulr'                     => 't-shart',
                'meta_title'             => '',
                'meta_description'       => '',
                'meta_keyword'           => '',
                'status'                 => 1,
            ],
            [
                'id'                    => 2, 
                'category_name'         => 'casual t-shart',
                'parent_id'             => 1,
                'section_id'             => 1,
                'category_image'         => '',
                'category_discount'      => 0,
                'description'            => '',
                'ulr'                     => 'casual t-shart',
                'meta_title'             => '',
                'meta_description'       => '',
                'meta_keyword'           => '',
                'status'                 => 1,
            ]
        ];


        Category::insert($categoryRecords);
    }
}
