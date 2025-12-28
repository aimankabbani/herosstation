<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneNumberController;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainSiteController::class, 'index'])->name('main.index');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('customer')->group(function () {
    Route::get('/bowling-station', [PhoneNumberController::class, 'bowlingStation'])->name('bowling-station.index');
    Route::get('/carting-station', [PhoneNumberController::class, 'cartingStation'])->name('carting-station.index');
    Route::post('/bowling-station', [PhoneNumberController::class, 'create'])->name('phone.store');
});

Route::middleware(['web', 'resolve.site'])->group(function () {
    Route::get('/{slug}/{page?}', [PageController::class, 'show'])->name('site.page');
});
