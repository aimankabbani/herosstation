<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    public function run()
    {
        // Get all sites
        $sites = Site::all();

        foreach ($sites as $site) {
            // Check if a 'home' page already exists
            if (!$site->pages()->where('slug', 'home')->exists()) {
                $site->pages()->create([
                    'title' => 'Home',
                    'slug' => 'home',
                    'content' => "<h1>Welcome to {$site->name}</h1><p>This is the home page of {$site->name}.</p>",
                    'order' => 0,
                    'is_published' => true,
                ]);
            }

            // Optional: Add more pages per site
            if (!$site->pages()->where('slug', 'about')->exists()) {
                $site->pages()->create([
                    'title' => 'About Us',
                    'slug' => 'about',
                    'content' => "<h1>About {$site->name}</h1><p>Information about this site.</p>",
                    'order' => 1,
                    'is_published' => true,
                ]);
            }

            if (!$site->pages()->where('slug', 'contact')->exists()) {
                $site->pages()->create([
                    'title' => 'Contact Us',
                    'slug' => 'contact',
                    'content' => "<h1>Contact {$site->name}</h1><p>Contact form or info here.</p>",
                    'order' => 2,
                    'is_published' => true,
                ]);
            }
        }
    }
}
