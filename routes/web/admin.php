<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::prefix('/admin')->middleware('auth', 'verify' ,'isadmin', )->group(function(){

    Route::get('/sendsms', [AuthController::class, 'sendsms']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');//show dashboard page

    //----------------------Profile----------------------------//
    Route::get('/profile', [UserController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/createuser/store', [UserController::class, 'store_user']); 
    Route::get('/profile/edit/{id}', [UserController::class, 'edit_user'])->name('users.show');
    Route::put('/profile/update/{id}', [UserController::class, 'update_user']); 
    Route::delete('/profile/delete/{id}', [UserController::class, 'delete_user']); 
    Route::get('/profile/pagination/paginate-data', [UserController::class, 'profile_paginate']);

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
    Route::get('/appointment/show_user', [AdminController::class, 'fetch_user']);
    Route::put('/appointment/resched', [AdminController::class, 'resched_appointment']);

    //-------------------Queuing---------------------------//
    Route::get('/queuing', [AdminController::class, 'view_queuing']);
    Route::get('/queuing/upcoming', [AdminController::class, 'upcoming_queuing']);

    //----------------------transaction----------------------------//
    Route::get('/transaction', [AdminController::class, 'view_transaction']); 
    Route::get('/transaction/getid', [AdminController::class, 'get_id']);
    Route::post('/transaction/addtocart/store', [AdminController::class, 'store_addtocart']);
    Route::post('/transaction/addtocart/billing_store', [AdminController::class, 'store_billing']);
    Route::delete('/transaction/delete/{id}', [AdminController::class, 'delete_transaction']);

    //----------------------Billing----------------------------//
    Route::get('/billing', [AdminController::class, 'index_billing']);
    Route::get('/billing/getdiscount/{id}', [AdminController::class, 'get_discount']);
    Route::post('/billing/addtocart/delete', [AdminController::class, 'store_delete']);
    Route::put('/billing/update/payment/{id}', [AdminController::class, 'update_payment']);
    Route::get('/billing/viewBilling/{id}', [AdminController::class, 'view_billing']);
    Route::get('/billing/editBilling/{id}', [AdminController::class, 'edit_billing']);
    Route::delete('/billing/deleteBilling/{id}', [AdminController::class, 'delete_billing']);
    Route::get('/billing/getdata/{id}', [AdminController::class, 'addtocart_getalldata']); 
    

    //----------------consultation ---------------- //
    Route::get('/consultation', [AdminController::class, 'index_consultation']);
    Route::get('/consultation/show_appointment', [AdminController::class, 'index_consultation_appointment_show']);
    Route::get('/consultation/create', [AdminController::class, 'create_consultation']);
    Route::get('/consultation/getappointment/{id}', [AdminController::class, 'get_consultation_appointment']);
    Route::post('/consultation/store', [AdminController::class, 'consultation_store']);
    Route::get('/consultation/viewrecords/{id}', [AdminController::class, 'consultation_view_records'])->name('consultation.show_history');
    Route::get('/consultation/edit/{id}/{user_id}', [AdminController::class, 'consultation_edit']);
    Route::get('/consultation/viewconsultation/{id}/{user_id}', [AdminController::class, 'consultation_view'])->name('consultation.viewappointment');
    Route::put('/consultation/update/{id}', [AdminController::class, 'consultation_update']);
    
    //-------------------Documents---------------------------//
    Route::get('/document', [AdminController::class, 'index_document']);
    Route::get('/document/show_appointment', [AdminController::class, 'document_show_appointment']);
    Route::post('/document/store', [AdminController::class, 'store_document']);
    Route::get('/document/edit/{id}', [AdminController::class, 'edit_document']);
    Route::post('/document/update/{id}', [AdminController::class, 'update_document']);
    Route::delete('/document/delete/{id}', [AdminController::class, 'delete_document']);

    //----------------------reports----------------------------//
    Route::get('/reports/user', [ReportController::class, 'view_user']);
    Route::get('/reports/audit_trail', [ReportController::class, 'view_auditTrail']);
    Route::get('/reports/appointment', [ReportController::class, 'view_appointment']);
    Route::get('/reports/billing', [ReportController::class, 'view_billing']);

    //-----------------------prints  ---------------------------------//
    Route::post('/reports/print_user', [PrintController::class, 'print_user']);
    Route::post('/reports/print_audit_trail', [PrintController::class, 'print_auditTrail']); 
    Route::post('/reports/print_appointment', [PrintController::class, 'print_appointment']); 
    Route::get('/billing/printinvoice/{id}', [PrintController::class, 'print_invoice']); 
    Route::post('/reports/print_billing', [PrintController::class, 'print_billing']);
    Route::get('/appointment/print/{id}', [PrintController::class, 'print_appointment_trans']);
    Route::get('/consultation/print/{id}', [PrintController::class, 'print_consultation_result']);
    Route::get('/document/download/{id}', [PrintController::class, 'download_transaction']);


    //----------------------discount----------------------------//
    Route::get('/discount', [AdminController::class, 'discount_show'])->name('discount.show');   //display discount table
    Route::post('/discount/creatediscount/store', [AdminController::class, 'store_discount']) ;  //create discount
    Route::get('/discount/edit/{discountcode}', [AdminController::class, 'edit_discount']); //display editable discount
    Route::put('/discount/update/{discountcode}', [AdminController::class, 'update_discount']);  //store updated discount  
    Route::delete('/discount/delete/{discountcode}', [AdminController::class, 'delete_discount']); //delete discount

    //----------------------service----------------------------//
    Route::get('/service', [AdminController::class, 'service_show'])->name('service.show'); //display service table
    Route::post('/service/createservice/store', [AdminController::class, 'store_service']) ;    //create service
    Route::get('/service/edit/{servicecode}', [AdminController::class, 'edit_service']);    //display editable discount
    Route::put('/service/update/{servicecode}', [AdminController::class, 'update_service']);    //store updated discount
    Route::delete('/service/delete/{servicecode}', [AdminController::class, 'delete_service']); //delete discount


    //--------------------business Hours -----------------------//
    Route::get('/business_hours', [AdminController::class, 'show_businesshours']);
    Route::post('/business_hours/store', [AdminController::class, 'store_businesshours']);
    Route::post('/business_hours/store_date', [AdminController::class, 'store_businesshours_date']);
    
    Route::post('/business_hours/delete', [AdminController::class, 'delete_businesshours']);
    Route::delete('/business_hours/date/delete', [AdminController::class, 'delete_date_businesshours']);
    Route::get('/business_hours/get_hours', [AdminController::class, 'get_hours']);
    Route::put('/business_hours/off_status', [AdminController::class, 'off_status']);
    
    //--------------------mode of payment-----------------------//
    Route::get('/modeofpayment', [AdminController::class, 'index_modeofpayment']);
    Route::post('/modeofpayment/store', [AdminController::class, 'store_modeofpayment']);
    Route::get('/modeofpayment/edit/{id}', [AdminController::class, 'edit_modeofpayment']);
    Route::post('/modeofpayment/update/{id}', [AdminController::class, 'update_modeofpayment']);
    Route::delete('/modeofpayment/delete/{id}', [AdminController::class, 'delete_modeofpayment']);

    //--------------------Guest page -----------------------//
    Route::get('/guestpage', [AdminController::class, 'show_guestpage_setting']);
    Route::get('/guestpage/edit/{id}', [AdminController::class, 'edit_guestpage_setting']);
    Route::put('/guestpage/update/{id}', [AdminController::class, 'update_guestpage_setting']);

    //------------------reservation fee-------------------//
    Route::get('/reservationfee', [AdminController::class, 'index_reservationfee_setting']);
    Route::put('/reservationfee/update/{id}', [AdminController::class, 'update_reservationfee_setting']);
    
    //------------------profile-------------------//
    Route::get('/myprofile', [AdminController::class, 'index_myprofile']);
    Route::get('/myprofile/edit', [AdminController::class, 'edit_myprofile']);
    Route::post('/myprofile/update', [AdminController::class, 'update_myprofile']);
    Route::get('/myprofile/changepassword', [AdminController::class, 'index_changepass']);
    Route::post('/myprofile/changepassword/update', [AdminController::class, 'update_changepass']);
    Route::post('/myprofile/picture/update/{id}', [AdminController::class, 'update_profile_pic']);

    //------------------ Pending user -----------------//
    Route::get('/pendinguser', [AdminController::class, 'index_pendinguser']);
    Route::post('/pendinguser/status/{id}', [AdminController::class, 'update_pendinguser']);

    Route::get('/data/get', [AdminController::class, 'get_filterdata']);

});

