<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Site;
use Illuminate\Http\Request;

class MainSiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        $ads = Ads::active()->get();
        return view('welcome', compact('sites','ads'));
    }
}
