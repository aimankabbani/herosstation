<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => 'ar|en'],
    'middleware' => 'setLocale'
], function () {

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
});
