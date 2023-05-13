<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicuserController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\GuestpageController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\UserController;
use App\Mail\HelloMail;
use App\Models\Appointment;
use App\Models\Clinicuser;
use App\Models\Service;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/about_us', [GuestpageController::class, 'aboutus']);
    Route::get('/', [GuestpageController::class, 'index_guestpage']);
    Route::get('/login', function () {return view('auth.login');})->name('login');
    Route::get('/register', function () {return view('auth.register');});
    Route::post('/store', [ClinicuserController::class, 'store']);
    Route::get('/confirmemail', [ClinicuserController::class , 'confirmemail']);
 
});

Route::get('try', [ClinicuserController::class, 'try']);


Route::post('/login/process', [ClinicuserController::class, 'process']);


Route::post('/logout', [ClinicuserController::class, 'logout'])->name('logout');

Route::get('/previous-page', function () {
    return redirect()->back();
})->name('previous.page');

Route::group(['middleware' => ['auth']], function() {

    //-----------search------------//

    Route::get('/diagnosis/filter/{year}', [SearchController::class, 'filter_diagnosis']);
    Route::get('/profile/search-name', [SearchController::class, 'profile_search_user']);
    Route::get('/profile/search-usertype', [SearchController::class, 'search_usertype']);
    Route::get('/appointment/search-name', [SearchController::class, 'appointment_search_user']);
    Route::get('/getservice/{id}', [AdminController::class, 'get_service']);
    Route::get('/getdiscount/{id}', [AdminController::class, 'get_discount']);
    Route::get('/discount', [AdminController::class, 'index_discount']);

    //----------filter report -----------//

    //-----user----//
    Route::get('/report/user_fullname', [SearchController::class, 'search_user']);
    Route::get('/report/user_status', [SearchController::class, 'search_user_status']);
    Route::get('/report/user_usertype', [SearchController::class, 'search_user_usertype']);
    
    //----appointment----//
    Route::get('/report/appointment/fullname', [SearchController::class, 'search_appointment_user']);
    Route::get('/report/appointment/date', [SearchController::class, 'search_appointment_date']);
    Route::get('/report/appointment/status', [SearchController::class, 'search_appointment_status']);
    
    // -------billing -----------//
    Route::get('/report/billing/fullname', [SearchController::class, 'search_billing_user']);
    Route::get('/report/billing/date', [SearchController::class, 'search_billing_date']);
    Route::get('/report/billing/status', [SearchController::class, 'search_billing_status']);
    Route::get('/report/billing/mop', [SearchController::class, 'search_billing_mop']);

    // -------Audit trail -----------//
    Route::get('/report/audittrail/username', [SearchController::class, 'search_audittrail_user']);
    Route::get('/report/audittrail/date', [SearchController::class, 'search_audittrail_date']);
    Route::get('/report/audittrail/usertype', [SearchController::class, 'search_audittrail_usertype']);




    //--------- paginate report --------- //
    Route::get('/report/users/pagination/paginate-data', [PaginationController::class, 'report_user_paginate']);
    Route::get('/report/appointments/pagination/paginate-data', [PaginationController::class, 'report_appointment_paginate']);
    Route::get('/report/billings/pagination/paginate-data', [PaginationController::class, 'report_billing_paginate']);
    Route::get('/report/audits/pagination/paginate-data', [PaginationController::class, 'report_audits_paginate']);
});

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

Route::prefix('/secretary')->middleware('auth', 'verify' ,'issecretary' )->group(function(){
    
        Route::get('/dashboard',  [SecretaryController::class, 'dashboard'] );

        //-------------------Users -------------------------------//
        Route::get('/profile', [SecretaryController::class, 'profile'])->name('secretary.profile') ;  
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

Route::prefix('/patient')->middleware('auth','ispatient', 'verify')->group(function(){

    Route::get('/homepage', [PatientController::class, 'homepage'])->name('patient.homepage');
    Route::get('/about_us', [GuestpageController::class, 'aboutus']);
    //--------------profile-------------------------//
    Route::get('/profile', [PatientController::class, 'profileshow'])->name('patient.profile') ;
    Route::get('/profile/edit', [PatientController::class, 'edit_profile']);
    Route::put('/profile/update/{id}', [PatientController::class, 'update_profile']);
    Route::put('/appointment/cancel/{id}', [PatientController::class, 'cancel_appointment']);
    Route::get('/document/view/{id}', [PatientController::class, 'document_view']);
    Route::post('/profile/picture/update/{id}', [PatientController::class, 'image_profile_update']);
    Route::get('/resched_count/{id}', [PatientController::class, 'resched_count']);
    Route::put('/appointment/resched', [AdminController::class, 'resched_appointment']);

   
    // ------------ appointment -------------------//
    Route::get('/appointment', [FullCalendarController::class, 'index']);
    Route::get('/appointment/business-hour', [FullCalendarController::class, 'index_businesshour']);
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



//unverified email
Route::get('/verify-email-auth', [AuthController::class, 'verifyemail_auth'])->middleware('auth') ; 
Route::get('/resend/auth', [AuthController::class, 'resendcode_verify'])->middleware('auth') ; 


//verify email register
Route::get('/verify-email', [AuthController::class, 'verifyemail']); //show find email
Route::get('/resendCode/create/{email}', [AuthController::class, 'resend_code_create']);
Route::post('/verifyconfirm', [AuthController::class, 'emailverifycode']);


// ---- FORGOT PASSWORD ---------//
Route::get('/identify', [AuthController::class, 'identify_email']); //show find email
Route::get('/confirm', [AuthController::class, 'confirm_email']); //find if email exixst
Route::get('/select', [AuthController::class, 'index_select'])->middleware('auth'); //
Route::post('/select/sendcode', [AuthController::class, 'select_sendcode'])->middleware('auth'); //
Route::get('/verifycode/email', [AuthController::class, 'show_verifycode_email'])->middleware('auth'); // display send otp by email 
Route::get('/resendCode', [AuthController::class, 'resend_code'])->middleware('auth'); //resend code via email
Route::get('/verifycode/sms', [AuthController::class, 'show_verifycode_sms'])->middleware('auth'); // display send otp by email 
Route::get('/resendCode/sms', [AuthController::class, 'resend_code_sms'])->middleware('auth'); //resend code via sms
Route::get('/resetpassword', [AuthController::class, 'reset_password'])->middleware('auth'); //show reset password form
Route::get('/resetpage', [AuthController::class, 'show_reset'])->middleware('auth'); //showreset page
Route::put('/updatepassword', [AuthController::class, 'update_password'])->middleware('auth');









