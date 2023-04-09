<?php

use App\Http\Controllers\AdminController;
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
use App\Mail\HelloMail;
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
    Route::get('/', [GuestpageController::class, 'index_guestpage']);
    Route::get('/login', function () {return view('auth.login');})->name('login');
    Route::get('/register', function () {return view('auth.register');});
    Route::post('/store', [ClinicuserController::class, 'store']);
    Route::get('/confirmemail', [ClinicuserController::class , 'confirmemail']);
    Route::post('/login/process', [ClinicuserController::class, 'process']);
});

Route::post('/logout', [ClinicuserController::class, 'logout'])->name('logout');


Route::get('/hello', function () {return view('hello');});
Route::get('/dashboard', function () {return view('dashboard');});



Route::get('/View_upload', function(){
    $service = Upload::all();
    return view('upload')->with('uploads', $service);
});

Route::post('/upload', [AdminController::class, 'upload_file']);

Route::get('/upload/show/{id}', [AdminController::class, 'upload_show']);
Route::get('/upload/download/{file}', [AdminController::class, 'upload_download']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/modal', function () {return view('admin.modal.create');});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile/search-name', [SearchController::class, 'profile_search_user']);
    Route::get('/report/search-name', [SearchController::class, 'search_user']);
    Route::get('/profile/search-usertype', [SearchController::class, 'search_usertype']);
    Route::get('/appointment/search-name', [SearchController::class, 'appointment_search_user']);
    Route::get('/modal_profile/search-name', [SearchController::class, 'modal_profile']);
    Route::get('/queuing_fullname/search-name', [SearchController::class, 'queuing_fullname']);
    Route::get('/getservice/{id}', [AdminController::class, 'get_service']);
    Route::get('/getdiscount/{id}', [AdminController::class, 'get_discount']);
    Route::get('/discount', [AdminController::class, 'index_discount']);
});

Route::prefix('/admin')->middleware('auth', 'verify' ,'isadmin', )->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');//show dashboard page

    //----------------------Profile----------------------------//
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile') ;  //display users
    Route::post('/profile/createuser/store', [AdminController::class, 'store_user']);   //save users in database
    Route::get('/profile/edit/{id}', [AdminController::class, 'edit_user'])->name('users.show');//show edit user
    Route::put('/profile/update/{id}', [AdminController::class, 'update_user']); //update user data
    Route::delete('/profile/delete/{id}', [AdminController::class, 'delete_user']); //delete user data
    Route::get('/profile/pagination/paginate-data', [AdminController::class, 'profile_paginate']);

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

     //----------------------appointment----------------------------//
    Route::get('/appointment', [AdminController::class, 'appointment_show'])->name('appointment.show'); 
    Route::post('/appointment/create', [AdminController::class, 'store_appointment']); 
    Route::put('/appointment/change_status/{id}', [AdminController::class, 'appointment_change_status']); 
    Route::delete('/appointment/delete/{id}', [AdminController::class, 'delete_appointment']);
    Route::get('/appointment/getuser/{id}', [AdminController::class, 'get_user']); 
    Route::get('/appointment/Calendar-fetch', [AdminController::class, 'get_time']); 
    Route::get('/appointment/pagination/paginate-data', [PaginationController::class, 'appointment_paginate']);
    Route::get('/modal_patient/pagination/paginate-data', [PaginationController::class, 'patient_paginate']);
    Route::get('/appointment/status/{id}', [AdminController::class, 'appointment_status']);


     //----------------------reports----------------------------//
     Route::get('/reports/user', [ReportController::class, 'view_user']);
     Route::get('/reports/audit_trail', [ReportController::class, 'view_auditTrail']);
     Route::get('/reports/appointment', [ReportController::class, 'view_appointment']);

    //-----------------------print report---------------------------------//
     Route::get('/reports/print_user', [PrintController::class, 'print_user']);
     Route::get('/reports/print_audit_trail', [PrintController::class, 'print_auditTrail']); 
     Route::get('/reports/print_appointment', [PrintController::class, 'print_appointment']);  


      //----------------------transaction----------------------------//
      Route::get('/transaction', [AdminController::class, 'view_transaction']); 
      Route::post('/transaction/store', [AdminController::class, 'store_transaction']); 
      Route::get('/transaction/getuser/{id}', [AdminController::class, 'getappointment_user']);
      Route::delete('/transaction/delete/{id}', [AdminController::class, 'delete_transaction']);
      Route::get('/transaction/edit/{id}', [AdminController::class, 'edit_transaction']);
      Route::post('/transaction/update/{id}', [AdminController::class, 'update_transaction']);
      Route::get('/transaction/download/{id}', [PrintController::class, 'upload_download_transaction']);
      Route::get('/transaction/view/{id}', [PrintController::class, 'upload_view_transaction']);
      

        //----------------------Billing----------------------------//
        Route::get('/billing', [AdminController::class, 'view_billing']);
        Route::get('/billing/getservice/{id}', [AdminController::class, 'get_service']);
        Route::get('/billing/getdiscount/{id}', [AdminController::class, 'get_discount']);
        Route::get('/billing/getid', [AdminController::class, 'get_id']);
        Route::put('/appointment/book/{id}', [AdminController::class, 'appointment_book']);
        Route::post('/billing/addtocart/store', [AdminController::class, 'store_addtocart']);
        Route::post('/billing/addtocart/delete', [AdminController::class, 'store_delete']);
        Route::post('/billing/addtocart/deleteall', [AdminController::class, 'deleteall_addtocart']);
        Route::get('/billing/pagination/paginate-data', [AdminController::class, 'addtocart_paginate']);
        Route::get('/billing/addtocart/getdata', [AdminController::class, 'addtocart_getalldata']); //condition if addtocart table has data
        
         //-------------------Queuing---------------------------//
         Route::get('/queuing', [AdminController::class, 'view_queuing']);
         Route::get('/queuing/pagination/paginate-data', [PaginationController::class, 'queuing_paginate']);
        
        
        //-------------------upload---------------------------//



        //--------------------prescription -----------------------//
        Route::get('/prescription', [PrescriptionController::class, 'show_prescription']);

        //--------------------business Hours -----------------------//
        Route::get('/business_hours', [AdminController::class, 'show_businesshours']);
        Route::post('/business_hours/store', [AdminController::class, 'store_businesshours']);
        Route::post('/business_hours/delete', [AdminController::class, 'delete_businesshours']);
        Route::get('/business_hours/get_hours', [AdminController::class, 'get_hours']);
        Route::put('/business_hours/off_status', [AdminController::class, 'off_status']);

        //--------------------Guest page -----------------------//
        Route::get('/guestpage', [AdminController::class, 'show_guestpage_setting']);
        Route::get('/guestpage/edit/{id}', [AdminController::class, 'edit_guestpage_setting']);
        Route::put('/guestpage/update/{id}', [AdminController::class, 'update_guestpage_setting']);



});

    Route::prefix('/secretary')->middleware('auth', 'verify' ,'issecretary' )->group(function(){
    Route::get('/dashboard',  [SecretaryController::class, 'dashboard'] );

    Route::get('/profile', [SecretaryController::class, 'profile'])->name('secretary.profile') ;  //display users
    Route::get('/profile/createuser', [SecretaryController::class, 'create_user_page']) ;   //create users
    Route::post('/profile/createuser/store', [SecretaryController::class, 'store_user']);   //save users in database
    // Route::get('/profile/edit/{id}', [AdminController::class, 'show_user']);  
    Route::get('/profile/edit/{id}', [SecretaryController::class, 'edit_user']);//show edit user
    Route::put('/profile/update/{id}', [SecretaryController::class, 'update_user']); //update user data
    Route::delete('/profile/delete/{id}', [SecretaryController::class, 'delete_user']); //delete user data

    //discount(done)
    Route::get('/discount', [SecretaryController::class, 'discount_show']);   //display discount table
    Route::get('/discount/creatediscount', [SecretaryController::class, 'create_discount']) ; //display (wala na to)
    Route::post('/discount/creatediscount/store', [SecretaryController::class, 'store_discount']) ;  //create discount
    Route::get('/discount/edit/{discountcode}', [SecretaryController::class, 'edit_discount']); //display editable discount
    Route::put('/discount/update/{discountcode}', [SecretaryController::class, 'update_discount']);  //store updated discount  
    Route::delete('/discount/delete/{discountcode}', [SecretaryController::class, 'delete_discount']); //delete discount

    //service
    Route::get('/fetch-service', [SecretaryController::class, 'fetch_service']); 
    Route::get('/service', [SecretaryController::class, 'service_show']); 
    //display
    // Route::get('/service/createservice', [AdminController::class, 'create_service']) ; 
    //create discount
    Route::post('/service/createservice/store', [SecretaryController::class, 'store_service']) ; 
    //display editable discount
    Route::get('/service/edit/{servicecode}', [SecretaryController::class, 'edit_service']);
    //store updated discount
    Route::put('/service/update/{servicecode}', [SecretaryController::class, 'update_service']);   
    //delete discount
    Route::delete('/service/delete/{servicecode}', [SecretaryController::class, 'delete_service']); //delete discount

    //appointment page
    Route::get('/appointment', [SecretaryControllerr::class, 'appointment_show']); 


});

Route::prefix('/patient')->middleware('auth','ispatient', 'verify')->group(function(){

    Route::get('/homepage', [PatientController::class, 'homepage'])->name('patient.homepage');
    //--------------profile-------------------------//
    Route::get('/profile', [PatientController::class, 'profileshow'])->name('patient.profile') ;
    Route::get('/profile/edit', [PatientController::class, 'edit_profile']);
    Route::put('/profile/update/{id}', [PatientController::class, 'update_profile']);
    Route::put('/appointment/cancel/{id}', [PatientController::class, 'cancel_appointment']);
    Route::get('/transaction/view/{id}', [PrintController::class, 'upload_view_transaction']);
    Route::get('/transaction/download/{id}', [PrintController::class, 'upload_download_transaction']);
   
    // ------------ appointment -------------------//
    Route::get('/appointment', [FullCalendarController::class, 'index']);
    Route::get('/appointment/business-hour', [FullCalendarController::class, 'index_businesshour']);
    Route::post('/action', [FullCalendarController::class,'store']);
    Route::get('/service-get/{servicename}', [FullCalendarController::class,'getprice']);
    Route::post('/appointment/create', [FullCalendarController::class, 'create']);

    //---------------- billing ---------------------//
    Route::get('/billing', [PatientController::class, 'index_billing']);
    Route::get('/billing/payment', [PatientController::class, 'index_payment']);
    Route::post('/billing/payment/store', [PatientController::class, 'store_payment']);
});


Route::get('/identify', [AuthController::class, 'identify_email']); //show find email
Route::get('/confirm', [AuthController::class, 'confirm_email']); //find if email exixst
Route::get('/verifycode', [AuthController::class, 'show_verifycode'])->middleware('auth'); //show verifycode page
Route::get('/resendCode', [AuthController::class, 'resend_code'])->middleware('auth');
Route::get('/resetpassword', [AuthController::class, 'reset_password'])->middleware('auth'); //show reset password form
Route::get('/resetpage', [AuthController::class, 'show_reset'])->middleware('auth'); //showreset page
Route::put('/updatepassword', [AuthController::class, 'update_password'])->middleware('auth');
Route::get('/verify-email', [AuthController::class, 'verifyemail'])->middleware('auth'); //show find email
Route::put('/verifyconfirm', [AuthController::class, 'emailverifycode']);
Route::get('/auth', function () {return view('layouts.auth');});

// Route::get('/mail', function () {
//     Mail::to('ronnelardales2192@gmail.com')
//     ->send(new HelloMail());
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


