<?php

namespace App\Http\Controllers;

use App\Models\Halls;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function halls()
    {
        $halls = Halls::select('id', 'name_en')->get();

        return response()->json([
            'data' => $halls
        ]);
    }
}
