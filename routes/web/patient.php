<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front_EndController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\GuestpageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;


Route::prefix('/patient')->middleware('auth','ispatient', 'verify')->group(function(){

    Route::get('/homepage', [Front_EndController::class, 'homepage'])->name('patient.homepage');
    Route::get('/about_us', [Front_EndController::class, 'aboutus']);
    
    //--------------profile-------------------------//
    Route::get('/profile', [PatientController::class, 'profileshow'])->name('patient.profile') ;
    Route::get('/profile/edit/user={id}', [PatientController::class, 'edit_profile']);
    Route::put('/profile/update/{id}', [PatientController::class, 'update_profile']);
    Route::put('/appointment/cancel/{id}', [PatientController::class, 'cancel_appointment']);
    Route::get('/document/view/{id}', [PatientController::class, 'document_view']);
    Route::post('/profile/picture/update/{id}', [PatientController::class, 'image_profile_update']);
    Route::get('/resched_count/{id}', [PatientController::class, 'resched_count']);
    Route::put('/appointment/resched', [AdminController::class, 'resched_appointment']);

   
    // ------------ appointment -------------------//
    Route::get('/appointment', [FullCalendarController::class, 'index']);
    Route::post('/action', [FullCalendarController::class,'store']);
    Route::get('/service-get/{servicename}', [FullCalendarController::class,'getprice']);
    Route::post('/appointment/create', [FullCalendarController::class, 'create']);

    //---------------- billing ---------------------//
    Route::get('/billing', [PatientController::class, 'index_billing']);
    Route::get('/billing/payment', [PatientController::class, 'index_payment']);
    Route::get('/billing/getmop/{id}', [PatientController::class, 'get_mop']);
    Route::post('/billing/payment/store', [PatientController::class, 'store_payment']);


    //----------------Print --------------------//
    Route::get('/billing/printinvoice/{id}', [PrintController::class, 'print_invoice']);
    Route::get('/appointment/print/{id}', [PrintController::class, 'print_appointment_trans']); 
    Route::get('/transaction/download/{id}', [PrintController::class, 'upload_download_transaction']);
    Route::get('/transaction/view/{id}', [PrintController::class, 'upload_view_transaction']);
    Route::get('/document/download/{id}', [PrintController::class, 'download_transaction']);
});