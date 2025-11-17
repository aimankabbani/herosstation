<?php

namespace App\Http\Controllers;

use App\Http\Services\PhoneNumberService;
use App\Models\Countries;
use App\Models\Halls;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    protected $phoneNumberService;


    public function __construct(PhoneNumberService $service)
    {
        $this->phoneNumberService = $service;
    }

    public function index()
    {
        $countries = Countries::all();
        return view('user.create', ['countries' => $countries]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:9',
            'country_code' => 'required|string|max:4',
            'hall_id' => 'required|integer'
        ]);
        $data = $request->all();
        $phoneNumber =  $this->phoneNumberService->create($data);

        if ($phoneNumber) {
            return back()->with('success', 'Phone number saved successfully!');
        } else {
            return back()->with('error', 'Failed to save phone number. Please try again.');
        }
    }
}
