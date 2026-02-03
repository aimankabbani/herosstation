<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'time' => 'required',
            'note' => 'nullable|string',
            'phone_number' => 'required|string',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'site_id' => $request->site_id,
            'date' => $request->date,
            'time' => $request->time,
            'note' => $request->note,
            'phone_number' => $request->phone_number,
        ]);

        return response()->json([
            'status' => true,
            'reservation' => $reservation
        ]);
    }
}
