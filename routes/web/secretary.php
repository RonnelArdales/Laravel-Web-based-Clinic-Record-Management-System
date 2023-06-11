<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\UserController;

Route::prefix('/secretary')->middleware('auth', 'verify' ,'issecretary' )->group(function(){
    
    Route::get('/dashboard',  [SecretaryController::class, 'dashboard'] );

    //-------------------Users -------------------------------//
    Route::get('/profile', [SecretaryController::class, 'profile'])->name('secretary.profile') ;  
    Route::post('/profile/createuser/store', [UserController::class, 'store_user']);  
    Route::get('/profile/edit/{id}', [UserController::class, 'edit_user'])->name('users.show');
    Route::put('/profile/update/{id}', [UserController::class, 'update_user']);
    Route::delete('/profile/delete/{id}', [UserController::class, 'delete_user']); 
    Route::get('/profile/pagination/paginate-data', [UserController::class, 'profile_paginate']);

    //------------------ Pending user -----------------//
    Route::get('/pendinguser', [SecretaryController::class, 'index_pendinguser']);
    Route::post('/pendinguser/status/{id}', [SecretaryController::class, 'update_pendinguser']);

    //----------------------appointment----------------------------//
    Route::get('/appointment', [AppointmentController::class, 'appointment_show'])->name('appointment.show');
    Route::get('/complete-appointment', [AppointmentController::class, 'complete_appointment_show'])->name('complete-appointment.show'); 
    Route::get('/cancelled-appointment', [AppointmentController::class, 'cancel_appointment_show'])->name('cancelled-appointment.show'); 
    Route::get('/transaction-appointment', [AppointmentController::class, 'trans_appointment_show'])->name('trancaction-appointment.show');
    Route::post('/appointment/create', [AppointmentController::class, 'store_appointment']); 
    Route::put('/appointment/change_status/{id}', [AdminController::class, 'appointment_change_status']); 
    Route::delete('/appointment/delete/{id}', [AdminController::class, 'delete_appointment']);
    Route::get('/appointment/getuser/{id}', [AdminController::class, 'get_user']); 
    Route::get('/appointment/get_appointment_service/{id}', [AdminController::class, 'get_appointment_service']); 
    Route::get('/appointment/Calendar-fetch', [AdminController::class, 'get_time']); 
    Route::get('/appointment/status/{id}', [AdminController::class, 'appointment_status']);
    Route::get('/appointment/show_user', [AdminController::class, 'fetch_user']);
    Route::put('/appointment/resched', [AdminController::class, 'resched_appointment']);

    //-----------------queuing ------------------------//
    Route::get('/queuing', [SecretaryController::class, 'view_queuing']);
    Route::get('/queuing/upcoming', [SecretaryController::class, 'upcoming_queuing']);
    Route::get('/transaction/getid', [AdminController::class, 'get_id']);

    //-----------------Transaction ------------------------//
    Route::get('/transaction', [SecretaryController::class, 'view_transaction']); 
    Route::get('/transaction/getid', [SecretaryController::class, 'get_id']);
    Route::post('/transaction/addtocart/store', [SecretaryController::class, 'store_addtocart']);
    Route::post('/transaction/addtocart/billing_store', [SecretaryController::class, 'store_billing']);
    Route::delete('/transaction/delete/{id}', [SecretaryController::class, 'delete_transaction']);

    //----------------------Billing----------------------------//
    Route::get('/billing',[SecretaryController::class, 'index_billing']);
    Route::get('/billing/getdiscount/{id}', [SecretaryController::class, 'get_discount']);
    Route::get('/billing/getdata/{id}', [SecretaryController::class, 'addtocart_getalldata']);
    Route::put('/billing/update/payment/{id}', [AdminController::class, 'update_payment']);
    Route::get('/billing/viewBilling/{id}', [SecretaryController::class, 'view_billing']);
    Route::get('/billing/editBilling/{id}', [AdminController::class, 'edit_billing']);
    Route::delete('/billing/deleteBilling/{id}', [AdminController::class, 'delete_billing']);

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

    //----------------------discount----------------------------//
    Route::get('/discount', [SecretaryController::class, 'discount_show'])->name('discount.show');  
    Route::post('/discount/creatediscount/store', [SecretaryController::class, 'store_discount']) ; 
    Route::get('/discount/edit/{discountcode}', [SecretaryController::class, 'edit_discount']);
    Route::put('/discount/update/{discountcode}', [SecretaryController::class, 'update_discount']);
    Route::delete('/discount/delete/{discountcode}', [SecretaryController::class, 'delete_discount']);

    //----------------------service----------------------------//
    Route::get('/service', [SecretaryController::class, 'service_show'])->name('service.show'); 
    Route::post('/service/createservice/store', [AdminController::class, 'store_service']) ;   
    Route::get('/service/edit/{servicecode}', [AdminController::class, 'edit_service']);  
    Route::put('/service/update/{servicecode}', [AdminController::class, 'update_service']);    
    Route::delete('/service/delete/{servicecode}', [AdminController::class, 'delete_service']); 
    
        //--------------------business Hours -----------------------//
    Route::get('/business_hours', [SecretaryController::class, 'show_businesshours']);
    Route::post('/business_hours/store', [AdminController::class, 'store_businesshours']);
    Route::post('/business_hours/delete', [AdminController::class, 'delete_businesshours']);
    Route::get('/business_hours/get_hours', [AdminController::class, 'get_hours']);
    Route::put('/business_hours/off_status', [AdminController::class, 'off_status']);
    Route::delete('/business_hours/date/delete', [AdminController::class, 'delete_date_businesshours']);
    Route::post('/business_hours/store_date', [AdminController::class, 'store_businesshours_date']);

        //--------------------Guest page -----------------------//
    Route::get('/guestpage', [SecretaryController::class, 'show_guestpage_setting']);
    Route::get('/guestpage/edit/{id}', [SecretaryController::class, 'edit_guestpage_setting']);
    Route::put('/guestpage/update/{id}', [SecretaryController::class, 'update_guestpage_setting']);

        //------------------reservation fee-------------------//
    Route::get('/reservationfee', [SecretaryController::class, 'index_reservationfee_setting']);
    Route::put('/reservationfee/update/{id}', [AdminController::class, 'update_reservationfee_setting']);

    //--------------------mode of payment-----------------------//
    Route::get('/modeofpayment', [SecretaryController::class, 'index_modeofpayment']);
    Route::post('/modeofpayment/store', [AdminController::class, 'store_modeofpayment']);
    Route::get('/modeofpayment/edit/{id}', [AdminController::class, 'edit_modeofpayment']);
    Route::post('/modeofpayment/update/{id}', [AdminController::class, 'update_modeofpayment']);
    Route::delete('/modeofpayment/delete/{id}', [AdminController::class, 'delete_modeofpayment']);
        
        //------------------profile-------------------//
    Route::get('/myprofile', [SecretaryController::class, 'index_myprofile']);
    Route::get('/myprofile/edit', [SecretaryController::class, 'edit_myprofile']);
    Route::post('/myprofile/update', [SecretaryController::class, 'update_myprofile']);
    Route::get('/myprofile/changepassword', [SecretaryController::class, 'index_changepass']);
    Route::post('/myprofile/changepassword/update', [SecretaryController::class, 'update_changepass']);
    Route::post('/myprofile/picture/update/{id}', [SecretaryController::class, 'update_profile_pic']);




});