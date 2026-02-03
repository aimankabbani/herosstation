<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReserveNow;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::post('/rate', [RatingController::class, 'store']);
});

Route::get('/ratings/{site_id}', [RatingController::class, 'get']);

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => 'ar|en'],
    'middleware' => 'setLocale'
], function () {

    Route::get('reserve-now', [ReserveNow::class, 'index'])->name('reservation');

    Route::get('/', [MainSiteController::class, 'index'])->name('main.index');

    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    Route::prefix('customer')->group(function () {
        Route::get('/bowling-station', [PhoneNumberController::class, 'bowlingStation'])->name('bowling-station.index');
        Route::get('/carting-station', [PhoneNumberController::class, 'cartingStation'])->name('carting-station.index');
        Route::post('/bowling-station', [PhoneNumberController::class, 'create'])->name('phone.store');
    });

    Route::middleware(['web'])->group(function () {
        Route::get('/page/{slug}', [PageController::class, 'page'])->name('page.content');
    });

    Route::middleware(['web', 'resolve.site'])->group(function () {
        Route::get('/{slug}/{page?}', [PageController::class, 'show'])->name('site.page');
    });
});
