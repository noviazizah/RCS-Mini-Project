<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(); 

Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::post('/track', [TrackingController::class, 'track'])->name('track');



