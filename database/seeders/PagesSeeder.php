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
            // Home page
            if (!$site->pages()->where('slug', 'home')->exists()) {
                $site->pages()->create([
                    'title_en' => 'Home',
                    'title_ar' => 'الصفحة الرئيسية',
                    'slug' => 'home',
                    'type' => 'home', // <-- added type
                    'content_en' => "<h1>Welcome to {$site->name_en}</h1><p>This is the home page of {$site->name_en}.</p>",
                    'content_ar' => "<h1>مرحباً بكم في {$site->name_ar}</h1><p>هذه هي الصفحة الرئيسية لـ {$site->name_ar}.</p>",
                    'order' => 0,
                    'is_published' => true,
                ]);
            }

            // About page
            if (!$site->pages()->where('slug', 'about')->exists()) {
                $site->pages()->create([
                    'title_en' => 'About Us',
                    'title_ar' => 'من نحن',
                    'slug' => 'about',
                    'type' => 'about-us', // <-- added type
                    'content_en' => "<h1>About {$site->name_en}</h1><p>Information about this site.</p>",
                    'content_ar' => "<h1>عن {$site->name_ar}</h1><p>معلومات عن هذا الموقع.</p>",
                    'order' => 1,
                    'is_published' => true,
                ]);
            }

            // Contact page
            if (!$site->pages()->where('slug', 'contact')->exists()) {
                $site->pages()->create([
                    'title_en' => 'Contact Us',
                    'title_ar' => 'تواصل معنا',
                    'slug' => 'contact',
                    'type' => 'contact-us', // <-- added type
                    'content_en' => "<h1>Contact {$site->name_en}</h1><p>Contact form or info here.</p>",
                    'content_ar' => "<h1>تواصل مع {$site->name_ar}</h1><p>نموذج الاتصال أو المعلومات هنا.</p>",
                    'order' => 2,
                    'is_published' => true,
                ]);
            }
        }
    }
}
