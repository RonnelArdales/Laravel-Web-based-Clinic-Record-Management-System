<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('forgot_password')->group(function(){
    Route::get('/find_email', [ForgotPasswordController::class, 'findEmail_index']);
    Route::get('/find_email/process', [ForgotPasswordController::class, 'confirm_email']);

    Route::middleware(['auth'])->group(function(){
        Route::get('/select', [ForgotPasswordController::class, 'selectSend_index']);
        Route::post('/select/sendcode', [ForgotPasswordController::class, 'select_sendcode']);
        Route::get('/verifycode/email', [ForgotPasswordController::class, 'show_verifycode_email']); 
        Route::get('/verifycode/sms', [ForgotPasswordController::class, 'show_verifycode_sms']); 
        Route::get('/resendCode', [ForgotPasswordController::class, 'resend_code']);
        Route::get('/resendCode/sms', [ForgotPasswordController::class, 'resend_code_sms']);
        Route::get('/resetpassword', [ForgotPasswordController::class, 'reset_password']); 
        Route::get('/resetpage', [ForgotPasswordController::class, 'reset_index']);
        Route::put('/updatepassword', [ForgotPasswordController::class, 'update_password']);
    });
});