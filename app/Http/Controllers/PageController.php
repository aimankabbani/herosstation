<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($siteSlug, $pageSlug = null)
    {
        // Find the site
        $site = Site::where('slug', $siteSlug)->firstOrFail();

        // Find the page
        if ($pageSlug) {
            $page = $site->pages()->where('slug', $pageSlug)->first();
            if (!$page) {
                abort(404); // page slug does not exist
            }
        } else {
            // No pageSlug provided → fallback to first page
            $page = $site->pages()->first();
            if (!$page) {
                abort(404); // site has no pages at all
            }
        }
        
        return view('home', compact('site', 'page'));
    }
}
