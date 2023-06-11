<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/identify', [AuthController::class, 'identify_email']); //show find email
Route::get('/confirm', [AuthController::class, 'confirm_email']); //find if email exixst
Route::get('/select', [AuthController::class, 'index_select'])->middleware('auth'); //
Route::post('/select/sendcode', [AuthController::class, 'select_sendcode'])->middleware('auth'); //
Route::get('/verifycode/email', [AuthController::class, 'show_verifycode_email'])->middleware('auth'); // display send otp by email 
Route::get('/resendCode', [AuthController::class, 'resend_code'])->middleware('auth'); //resend code via email
Route::get('/verifycode/sms', [AuthController::class, 'show_verifycode_sms'])->middleware('auth'); // display send otp by email 
Route::get('/resendCode/sms', [AuthController::class, 'resend_code_sms'])->middleware('auth'); //resend code via sms
Route::get('/resetpassword', [AuthController::class, 'reset_password'])->middleware('auth'); //show reset password form
Route::get('/resetpage', [AuthController::class, 'show_reset']); //showreset page
Route::put('/updatepassword', [AuthController::class, 'update_password'])->middleware('auth');