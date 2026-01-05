<?php

namespace Database\Seeders;

use App\Models\Site;
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
                    'name_en' => "Site {$i}",
                    'name_ar' => "موقع {$i}",
                    'path_prefix' => "/site-{$i}",
                    'hero_title_en' => "Welcome to Site {$i}",
                    'hero_title_ar' => "مرحباً بكم في موقع {$i}",
                    'slogan_en' => "Your go-to platform for everything Site {$i}",
                    'slogan_ar' => "Your go-to platform for everything Site {$i}",
                    'hero_image_url' => "https://picsum.photos/1200/500?random={$i}", // Added hero image
                    'branding' => [
                        'primary_color' => '#0b74de',
                        'logo_path' => null,
                        'favicon_path' => null,
                        'custom_css' => ''
                    ],
                    'settings' => [
                        'phone_number' => null,
                    ],
                ]
            );
        }
    }
}
