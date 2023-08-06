<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\GuestpageController;
use App\Http\Controllers\PendingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\QueuingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\system_settings\BusinesshoursController;
use App\Http\Controllers\system_settings\DiscountController;
use App\Http\Controllers\system_settings\ModeofpaymentController;
use App\Http\Controllers\system_settings\ProfileController;
use App\Http\Controllers\system_settings\ReservationfeeController;
use App\Http\Controllers\system_settings\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::prefix('/secretary')->middleware('auth', 'verify' ,'issecretary' )->group(function(){
    
    Route::get('/dashboard',  [SecretaryController::class, 'dashboard'] );

    //---------------------- User ----------------------------//
    Route::get('/user/pagination/paginate-data', [UserController::class, 'profile_paginate']);
    route::resource('/user', UserController::class);  

    //------------------ Pending user -----------------//
    Route::resource('/pendinguser', PendingController::class);

    //----------------------appointment----------------------------//
    Route::get('/complete-appointment', [AppointmentController::class, 'complete_appointment_show'])->name('complete-appointment.show'); 
    Route::get('/cancelled-appointment', [AppointmentController::class, 'cancel_appointment_show'])->name('cancelled-appointment.show'); 
    Route::get('/transaction-appointment', [AppointmentController::class, 'trans_appointment_show'])->name('trancaction-appointment.show');
    Route::get('/appointment/show_user', [UserController::class, 'fetch_user']);
    Route::get('/appointment/getuser/{user}', [UserController::class, 'getUser']); //adminController
    Route::get('/appointment/Calendar-fetch', [FullCalendarController::class, 'get_time']); 
    Route::resource('/appointment', AppointmentController::class);

    //-----------------queuing ------------------------//
    Route::get('/queuing', [QueuingController::class, 'view_queuing']);
    Route::get('/queuing/upcoming', [QueuingController::class, 'upcoming_queuing']);

    //----------------------transaction----------------------------//
    Route::get('/transaction/getid', [TransactionController::class, 'get_id']);
    Route::get('/transaction/getservice/{id}', [ServiceController::class, 'get_service']);
    Route::post('/transaction/addtocart/store', [TransactionController::class, 'store_addtocart']);
    Route::post('/transaction/addtocart/billing_store', [TransactionController::class, 'store_billing']);
    Route::resource('/transaction', TransactionController::class); 

    //----------------------Billing----------------------------//
    Route::get('/billing/getdiscount/{id}', [DiscountController::class, 'get_discount']);
    Route::get('/billing/viewBilling/{id}', [BillingController::class, 'view_billing']);
    Route::resource('/billing', BillingController::class); 

    //----------------------reports----------------------------//
    Route::get('/reports/user', [ReportController::class, 'view_user']);
    Route::get('/reports/appointment', [ReportController::class, 'view_appointment']);
    Route::get('/reports/billing', [ReportController::class, 'view_billing']);
      
    //-----------------------prints  ---------------------------------//
    Route::get('/billing/printinvoice/{id}', [PrintController::class, 'print_invoice']); 
    Route::get('/appointment/print/{id}', [PrintController::class, 'print_appointment_trans']);
    Route::post('/reports/print_user', [PrintController::class, 'print_user']);
    Route::post('/reports/print_appointment', [PrintController::class, 'print_appointment']); 
    Route::post('/reports/print_billing', [PrintController::class, 'print_billing']);

    //----------------------service----------------------------//
    Route::resource('/service', ServiceController::class)->names([
        'index' =>'secretary.service.index',
    ]); 

    //----------------------discount----------------------------//
    Route::resource('/discount', DiscountController::class)->names([
        'index' =>'secretary.discount.index',
    ]); 
 
    //--------------------business Hours -----------------------//
    Route::get('/business_hours', [BusinesshoursController::class, 'index']);
    Route::post('/business_hours/store', [BusinesshoursController::class, 'store_businesshours_day']);
    Route::post('/business_hours/store_date', [BusinesshoursController::class, 'store_businesshours_date']);
    Route::delete('/business_hours/day/delete', [BusinesshoursController::class, 'delete_businesshours_day']);
    Route::delete('/business_hours/date/delete', [BusinesshoursController::class, 'delete_businesshours_date']);
    Route::get('/business_hours/get_hours', [BusinesshoursController::class, 'get_hours']);
    Route::put('/business_hours/off_status', [BusinesshoursController::class, 'off_status']);

    //--------------------Guest page -----------------------//
    Route::resource('/guestpage', GuestpageController::class)->names([
        'index' => 'secretary.guestpage.index',
        'edit' => 'secretary.guestpage.edit',
        'update' => 'secretary.guestpage.update',
    ]);

    //------------------reservation fee-------------------//
    Route::resource('/reservationfee', ReservationfeeController::class)->names([
        'index' => 'secretary.reservationfee.index',
        'update' => 'secretary.reservationfee.update',
    ]);

    //--------------------mode of payment-----------------------//
    Route::post('/modeofpayment/store', [ModeofpaymentController::class, 'store']);
    Route::post('/modeofpayment/update/{id}', [ModeofpaymentController::class, 'update']);
    Route::resource('/modeofpayment', ModeofpaymentController::class)->except(['show', 'update'])->names([
        'index' => 'secretary.modeofpayment.index',
    ]);
        
    //------------------profile-------------------//
    Route::get('/myprofile', [ProfileController::class, 'profile_index']);
    Route::get('/myprofile/edit', [ProfileController::class, 'profile_edit']);
    Route::post('/myprofile/update', [ProfileController::class, 'profile_update']);
    Route::get('/myprofile/changepassword', [ProfileController::class, 'changepassword_index']);
    Route::post('/myprofile/changepassword/update', [ProfileController::class, 'password_update']);
    Route::post('/myprofile/picture/update', [ProfileController::class, 'profile_pic']);




});