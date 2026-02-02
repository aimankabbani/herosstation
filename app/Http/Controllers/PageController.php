<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function page(Request $request, $locale, $slug)
    {
        
        $page = Page::select(
            "title_{$locale} as title",
            "content_{$locale} as content"
        )
            ->where('slug', $slug)
            ->where('is_published', true)
            ->get()
            ->first();
        return view('page', compact('page'));
    }

    public function show(Request $request, $locale, $slug, $page = null)
    {
        // Find the site
        $site = Site::where('slug', $slug)
            ->select(
                "id",
                "name_{$locale} as name",
                'slug',
                'domain',
                'path_prefix',
                'logo_path',
                'favicon_path',
                'branding',
                'settings',
                "hero_title_{$locale} as hero_title",
                "slogan_{$locale} as slogan",
                "hero_image_url"
            )
            ->with('media')->firstOrFail();

        // Find the page
        if ($page) {
            $page = $site->pages()->where('slug', $page)->first();
            if (!$page) {
                abort(404);
            }
        } else {
            // No page provided → fallback to first page
            $page = $site->pages()
                ->select(
                    'site_id',
                    "title_{$locale} as title",
                    'slug',
                    "content_{$locale} as content",
                    "is_published",
                    "order",
                    "type"
                )
                ->where('is_published', true)
                ->get()
                ->keyBy('type');

            if (!$page) {
                abort(404);
            }
        }

        return view('home', compact('site', 'page'));
    }
}
