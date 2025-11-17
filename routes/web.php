<?php

use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhoneNumberController::class, 'index']);
Route::post('/', [PhoneNumberController::class, 'create'])
    ->name('phone.store');
