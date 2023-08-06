<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicuserController;
use App\Http\Controllers\Front_EndController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    
    // front page
    Route::get('/', [Front_EndController::class, 'homepage']);
    Route::get('/about_us', [Front_EndController::class, 'aboutus']);

    // Login page
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/process', [LoginController::class, 'process']);

    // sign up
    Route::get('/register', [SignupController::class, 'index'] );
    Route::post('/store', [SignupController::class, 'store']);
    Route::get('/confirmemail', [ClinicuserController::class , 'confirmemail']);

    //verify email
    Route::get('/verify-email/{email}', [SignupController::class, 'verifyemail'])->name('verify-email');
    Route::get('/resendCode/create/{email}', [SignupController::class, 'resend_code_create']);
   
});

Route::post('/verifyconfirm/{email}', [SignupController::class, 'emailverifycode']);



