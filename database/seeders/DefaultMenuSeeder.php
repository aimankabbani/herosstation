<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\Menu;

class DefaultMenuSeeder extends Seeder
{
    public function run()
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            // Create main menu for the site if not exists
            $menu = $site->menus()->firstOrCreate([
                'name' => 'main',
                'title' => 'Main Menu',
            ]);

            // Default menu items
            $defaultItems = [
                ['title' => 'Home', 'page_slug' => 'home'],
                ['title' => 'About', 'page_slug' => 'about'],
                ['title' => 'Gallery', 'page_slug' => 'gallery'],
                ['title' => 'Contact', 'page_slug' => 'contact'],
            ];

            foreach ($defaultItems as $index => $item) {
                $page = $site->pages()->where('slug', $item['page_slug'])->first();

                $menu->items()->updateOrCreate(
                    ['title' => $item['title']], // unique by title per menu
                    [
                        'page_id' => $page?->id,   // link to internal page
                        'url' => null,             // external URL null
                        'order' => $index,         // menu order
                    ]
                );
            }
        }
    }
}
