<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug, $page = null)
    {
        // Find the site
        $site = Site::where('slug', $slug)->firstOrFail();

        // Find the page
        if ($page) {
            $page = $site->pages()->where('slug', $page)->first();
            if (!$page) {
                abort(404); // page slug does not exist
            }
        } else {
            // No page provided → fallback to first page
            $page = $site->pages()->first();
            if (!$page) {
                abort(404); // site has no pages at all
            }
        }
        
        return view('home', compact('site', 'page'));
    }
}
