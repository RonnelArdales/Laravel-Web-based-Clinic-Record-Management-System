<?php

use App\Http\Controllers\Front_EndController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\User\User_AppointmentController;
use App\Http\Controllers\User\User_ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('/patient')->middleware('verify','auth','ispatient', 'isforgetpassword')->group(function(){

    Route::get('/homepage', [Front_EndController::class, 'homepage'])->name('patient.homepage');
    Route::get('/about_us', [Front_EndController::class, 'aboutus']);
    
    //--------------profile page-------------------------//
    // document
    Route::get('/document/view/{id}', [User_ProfileController::class, 'view_document']);
    Route::get('/document/download/{id}', [PrintController::class, 'download_ConsultationFile']);
    // appointment
    Route::put('/appointment/cancel/{id}', [User_AppointmentController::class, 'cancel_appointment']);
    Route::get('/resched_count/{id}', [User_AppointmentController::class, 'resched_count']);
    Route::resource('/appointment', User_AppointmentController::class);
    // user
    Route::post('/profile/picture/update/{id}', [User_ProfileController::class, 'image_profile_update']);
    Route::resource('/profile', User_ProfileController::class);
   
    // ------------ appointment -------------------//
    Route::post('/action', [FullCalendarController::class,'get_time']);
    Route::get('/service-get/{servicename}', [FullCalendarController::class,'getprice']);
    Route::resource('/appointment', User_AppointmentController::class);

    //---------------- billing ---------------------//
    Route::get('/billing', [PatientController::class, 'index_billing']);
    Route::get('/billing/getmop/{id}', [PatientController::class, 'get_mop']);


    //----------------Print --------------------//
    Route::get('/billing/printinvoice/{id}', [PrintController::class, 'print_invoice']);
    Route::get('/appointment/print/{id}', [PrintController::class, 'print_appointment_trans']); 
    Route::get('/transaction/download/{id}', [PrintController::class, 'upload_download_transaction']);
    Route::get('/transaction/view/{id}', [PrintController::class, 'upload_view_transaction']);
   
});