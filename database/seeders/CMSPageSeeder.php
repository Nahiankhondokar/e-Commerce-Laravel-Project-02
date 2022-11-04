<?php

namespace Database\Seeders;

use App\Models\CMSPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CMSPageSeeder extends Seeder
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
                'id'                    => 1, 
                'title'                 => 'about-us',
                'desc'                  => 'this is about us page',
                'url'                   => 'about-us',
                'meta_title'            => 'about-us',
                'meta_desc'             => 'about-us',
            ],
            [
                'id'                    => 2, 
                'title'                 => 'contact-us',
                'desc'                  => 'this is contact us page',
                'url'                   => 'contact-us',
                'meta_title'            => 'contact-us',
                'meta_desc'             => 'contact-us',
            ]
        ];


        CMSPage::insert($record);
    }
}
