<?php

namespace Database\Seeders;

use App\Models\CreateSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            [
                'id'        => 1, 
                'name'      => 'man',
                'status'    => 1
            ],
            [
                'id'        => 2, 
                'name'      => 'woman',
                'status'    => 1
            ],
            [
                'id'        => 3, 
                'name'      => 'kids',
                'status'    => 1
            ],
        ];


        CreateSection::insert($sectionRecords);
    }
}
