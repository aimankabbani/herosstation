<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Countries;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MediaSeeder::class,
            CountriesTableSeeder::class,
            DefaultMenuSeeder::class,
            ExampleSitesSeeder::class,
            HallsSeeder::class,
            PagesSeeder::class,
            StaticSiteSeeder::class,
        ]);
    }
}
