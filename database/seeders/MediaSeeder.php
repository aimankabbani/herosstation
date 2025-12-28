<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Site;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $sites = Site::all();

        foreach ($sites as $site) {

            // Skip if media already exists (optional safety)
            if ($site->media()->exists()) {
                continue;
            }

            // Hero / images
            Media::factory(5)->create([
                'site_id' => $site->id,
                'type' => 'image',
            ]);

            // Videos
            Media::factory(2)->create([
                'site_id' => $site->id,
                'type' => 'video',
            ]);
        }
    }
}
