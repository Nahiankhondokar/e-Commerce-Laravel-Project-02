<?php

namespace Database\Seeders;

use App\Models\Currencie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            [
                'id'                    => 1, 
                'currnecie_code'         => 'USD',
                'currnecie_rate'         => 110,
            ],
            [
                'id'                    => 2, 
                'currnecie_code'         => 'EUR',
                'currnecie_rate'         => 120,
            ],
            [
                'id'                    => 3, 
                'currnecie_code'         => 'CAD',
                'currnecie_rate'        => 80,
            ],
            [
                'id'                    => 4, 
                'currnecie_code'         => 'GBP',
                'currnecie_rate'        => 100,
            ],
            [
                'id'                    => 5, 
                'currnecie_code'         => 'AUD',
                'currnecie_rate'        => 90,
            ]
        ];


        Currencie::insert($currency);
    }
}
