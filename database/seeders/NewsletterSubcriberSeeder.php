<?php

namespace Database\Seeders;

use App\Models\NewsletterSubcriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsletterSubcriberSeeder extends Seeder
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
                'email'         => 'amdin@gmail.com',
            ],
            [
                'id'            => 2, 
                'email'         => 'user@gmail.com',

            ]
        ];


        NewsletterSubcriber::insert($record);
    }
}
