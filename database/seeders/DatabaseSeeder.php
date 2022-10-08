<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory()->create();

        // $this->call([AdminSeeder::class]);
        // $this->call([SectionSeeder::class]);
        // $this->call([CategorySeeder::class]);
        // $this->call([ProductSeeder::class]);
        // $this->call([ProductAttributeSeeder::class]);
        $this->call([ProductGallerySeeder::class]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
