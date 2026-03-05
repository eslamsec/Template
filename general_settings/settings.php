<?php

use App\Http\Controllers\settings\GeneralSettingsController;
use Illuminate\Support\Facades\Route;



Route::group(
    ['prefix' => 'settings', 'as' => 'settings.', 'middleware' => 'auth'],
    function () {

        // Menu 

        // General Settings
        Route::group(['prefix' => 'general', 'as' => 'general.'], function () {

            Route::get('menu', function () {
                return view('settings.general.index');
            })->name('menu');
            Route::post('store', [GeneralSettingsController::class, 'store'])->name('store');
        });
    }
);
