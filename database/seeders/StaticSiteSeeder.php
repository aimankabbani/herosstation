<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\Page;

class StaticSiteSeeder extends Seeder
{
    public function run()
    {
        $sites = Site::all();

        foreach ($sites as $index => $site) {

            // Assign random branding per site
            $branding = [
                'primary_color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                'logo' => null, // you can upload default logos later
                'favicon' => null,
                'custom_css' => ''
            ];

            $site->update(['branding' => $branding]);

            // Home Page
            $site->pages()->updateOrCreate(
                ['slug' => 'home'],
                [
                    'title_en' => 'Home',
                    'title_ar' => 'Home',
                    'content_en' => "
                        <section style='padding:20px;'>
                            <h1 style='color: {$branding['primary_color']}'>Welcome to {$site->name}</h1>
                            <p>This is the home page for {$site->name}.</p>
                            <img src='https://picsum.photos/600/300?random={$index}' alt='Random Image'>
                        </section>
                    ",
                    'content_ar' => "
                        <section style='padding:20px;'>
                            <h1 style='color: {$branding['primary_color']}'>Welcome to {$site->name}</h1>
                            <p>This is the home page for {$site->name}.</p>
                            <img src='https://picsum.photos/600/300?random={$index}' alt='Random Image'>
                        </section>
                    ",
                    'order' => 0,
                    'is_published' => true,
                ]
            );

            // About Us Page
            $site->pages()->updateOrCreate(
                ['slug' => 'about'],
                [
                    'title_en' => 'About Us',
                    'title_ar' => 'About Us',
                    'content_en' => "
                        <section style='padding:20px;'>
                            <h2 style='color: {$branding['primary_color']}'>About {$site->name}</h2>
                            <p>Information about this website and its mission.</p>
                        </section>
                    ",
                    'content_ar' => "
                        <section style='padding:20px;'>
                            <h2 style='color: {$branding['primary_color']}'>About {$site->name}</h2>
                            <p>Information about this website and its mission.</p>
                        </section>
                    ",
                    'order' => 1,
                    'is_published' => true,
                ]
            );

            // Contact Us Page
            $site->pages()->updateOrCreate(
                ['slug' => 'contact'],
                [
                    'title_en' => 'Contact Us',
                    'title_ar' => 'Contact Us',
                    'content_en' => "
                        <section style='padding:20px;'>
                            <h2 style='color: {$branding['primary_color']}'>Contact {$site->name}</h2>
                            <form>
                                <label>Name:</label><br>
                                <input type='text' name='name'><br>
                                <label>Email:</label><br>
                                <input type='email' name='email'><br>
                                <label>Message:</label><br>
                                <textarea name='message'></textarea><br>
                                <button type='submit' style='background: {$branding['primary_color']}; color:white; padding:5px 10px;'>Send</button>
                            </form>
                        </section>
                    ",
                    'content_ar' => "
                        <section style='padding:20px;'>
                            <h2 style='color: {$branding['primary_color']}'>Contact {$site->name}</h2>
                            <form>
                                <label>Name:</label><br>
                                <input type='text' name='name'><br>
                                <label>Email:</label><br>
                                <input type='email' name='email'><br>
                                <label>Message:</label><br>
                                <textarea name='message'></textarea><br>
                                <button type='submit' style='background: {$branding['primary_color']}; color:white; padding:5px 10px;'>Send</button>
                            </form>
                        </section>
                    ",
                    'order' => 2,
                    'is_published' => true,
                ]
            );

            // Footer content (can be included in layout, but we can store as a page)
            $site->pages()->updateOrCreate(
                ['slug' => 'footer'],
                [
                    'title_en' => 'Footer',
                    'title_ar' => 'Footer',
                    'content_en' => "
                        <footer style='padding:20px; text-align:center; background: #f0f0f0;'>
                            &copy; " . date('Y') . " {$site->name} - All rights reserved.
                        </footer>
                    ",
                    'content_ar' => "
                        <footer style='padding:20px; text-align:center; background: #f0f0f0;'>
                            &copy; " . date('Y') . " {$site->name} - All rights reserved.
                        </footer>
                    ",
                    'order' => 99,
                    'is_published' => true,
                ]
            );
        }
    }
}
