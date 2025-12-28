<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleSitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Site::firstOrCreate(
                ['slug' => "site-{$i}"],
                [
                    'name' => "Site {$i}",
                    'path_prefix' => "/site-{$i}",
                    'branding' => [
                        'primary_color' => '#0b74de',
                        'logo' => null,
                        'favicon' => null,
                        'custom_css' => ''
                    ]
                ]
            );
        }
    }
}
