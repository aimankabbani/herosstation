<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class MainSiteController extends Controller
{
     public function index()
    {
        $sites = Site::all(); 
        return view('welcome', compact('sites'));
    }
}
