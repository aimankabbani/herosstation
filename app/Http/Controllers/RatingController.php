<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|integer',
            'stars' => 'required|integer|min:1|max:5',
            'note' => 'string|max:500'
        ]);
    
        $rating = Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'site_id' => $request->site_id
            ],
            [
                'stars' => $request->stars,
                'note' => $request->note
            ]
        );

        $average = Rating::where('site_id', $request->site_id)->avg('stars');

        return response()->json([
            'status' => true,
            'message' => 'Rating saved',
            'average' => $average
        ]);
    }

    public function get($site_id)
    {
        $ratings = Rating::where('site_id', $site_id)->with('user')->get();
        $average = $ratings->avg('stars');

        return response()->json([
            'average' => $average,
            'ratings' => $ratings
        ]);
    }
}
