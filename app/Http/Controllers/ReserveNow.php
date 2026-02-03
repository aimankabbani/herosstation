<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class ReserveNow extends Controller
{
    public function index()
    {
        $sites = Site::all();
        return view('reservation', compact('sites'));
    }
}
