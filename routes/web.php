<?php

use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::get('/bowling-station', [PhoneNumberController::class, 'index']);
Route::post('/bowling-station', [PhoneNumberController::class, 'create'])
    ->name('phone.store');
