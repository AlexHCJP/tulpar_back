<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            StoreSeeder::class,
            ProducerSeeder::class,
            CarModelSeeder::class,
            CarSeeder::class,
            PartGroupSeeder::class,
            PartSeeder::class,
            // ApiSeeder::class,
        ]);
    }
}
