<?php

use App\Http\Controllers\ClinicuserController;
use App\Http\Controllers\GuestpageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/about_us', [GuestpageController::class, 'aboutus']);
    Route::get('/', [GuestpageController::class, 'index_guestpage']);
    Route::get('/login', function () {return view('auth.login');})->name('login');
    Route::get('/register', function () {return view('auth.register');});
    Route::post('/store', [ClinicuserController::class, 'store']);
    Route::get('/confirmemail', [ClinicuserController::class , 'confirmemail']);
});

Route::post('/login/process', [ClinicuserController::class, 'process']);

Route::post('/logout', [ClinicuserController::class, 'logout'])->name('logout');