<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicuserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SecretaryController;
use App\Mail\HelloMail;
use App\Models\Clinicuser;
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

Route::get('/tutorial', function () {return view('tutorial');});
Route::get('/adapt', function () {return view('bootstrap_adapt');});

Route::get('/', function () {return view('Guest_homepage');});

Route::get('/confirmemail', [ClinicuserController::class , 'confirmemail']);

Route::get('/login', function () {return view('auth.login');})->name('login');

Route::get('/register', function () {return view('auth.register');});

//try
// Route::get('/dashboard', function () {return view('dashboard');});
// Route::get('/profile', function () {return view('profile');});

Route::post('/store', [ClinicuserController::class, 'store']);

Route::post('/login/process', [ClinicuserController::class, 'process']);

Route::post('/logout', [ClinicuserController::class, 'logout'])->name('logout');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/modal', function () {return view('admin.modal.create');});

Route::prefix('/admin')->middleware('auth', 'isadmin' )->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');//show dashboard page

    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile') ;  //display users
    Route::get('/profile/createuser', [AdminController::class, 'create_user_page']) ;   //create users
    Route::post('/profile/createuser/store', [AdminController::class, 'store_user']);   //save users in database
    // Route::get('/profile/edit/{id}', [AdminController::class, 'show_user']);  
    Route::get('/profile/edit/{id}', [AdminController::class, 'edit_user'])->name('users.show');//show edit user
    Route::put('/profile/update/{id}', [AdminController::class, 'update_user']); //update user data
    Route::delete('/profile/delete/{id}', [AdminController::class, 'delete_user']); //delete user data

    //discount(done)
    Route::get('/fetch-discount', [AdminController::class, 'fetch_discount']); //fetch disocunt data from database
    Route::get('/discount', [AdminController::class, 'discount_show'])->name('discount.show');   //display discount table
    Route::get('/discount/creatediscount', [AdminController::class, 'create_discount']) ; //display (wala na to)
    Route::post('/discount/creatediscount/store', [AdminController::class, 'store_discount']) ;  //create discount
    Route::get('/discount/edit/{discountcode}', [AdminController::class, 'edit_discount']); //display editable discount
    Route::put('/discount/update/{discountcode}', [AdminController::class, 'update_discount']);  //store updated discount  
    Route::delete('/discount/delete/{discountcode}', [AdminController::class, 'delete_discount']); //delete discount

    //service
    Route::get('/fetch-service', [AdminController::class, 'fetch_service']); 
    Route::get('/service', [AdminController::class, 'service_show'])->name('service.show'); 
    //display
    // Route::get('/service/createservice', [AdminController::class, 'create_service']) ; 
    Route::post('/service/createservice/store', [AdminController::class, 'store_service']) ;    //create discount
    //display editable discount
    Route::get('/service/edit/{servicecode}', [AdminController::class, 'edit_service']);
    //store updated discount
    Route::put('/service/update/{servicecode}', [AdminController::class, 'update_service']);   
    //delete discount
    Route::delete('/service/delete/{servicecode}', [AdminController::class, 'delete_service']); //delete discount

    //appointment page
    Route::get('/appointment', [AdminController::class, 'appointment_show'])->name('appointment.show'); 

});

Route::prefix('/secretary')->middleware('auth', 'issecretary' )->group(function(){
    Route::get('/dashboard', function () {return view('secretary.dashboard');});

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

Route::prefix('/patient')->middleware('auth', 'ispatient')->group(function(){
    Route::get('/homepage', function () {return view('patient.homepage');})->name('patient.homepage');
    //profile
    Route::get('/profile', [PatientController::class, 'profileshow'])->name('patient.profile') ;
    Route::get('/profile/edit', [PatientController::class, 'edit_profile']);
    Route::put('/profile/update/{id}', [PatientController::class, 'update_profile']);
});


Route::get('/identify', [AuthController::class, 'identify_email']); //show find email
Route::post('/confirm', [AuthController::class, 'confirm_email']); //find if email exixst
Route::get('/verifycode', [AuthController::class, 'show_verifycode'])->middleware('auth');; //show verifycode page
Route::post('/resetpassword', [AuthController::class, 'reset_password'])->middleware('auth');; //show reset password form
Route::get('/resetpage', [AuthController::class, 'show_reset'])->middleware('auth');; //show reset page
Route::put('/updatepassword', [AuthController::class, 'update_password'])->middleware('auth');;
Route::get('/verify-email', [AuthController::class, 'verifyemail']); //show find email
Route::post('/verifyconfirm', [AuthController::class, 'emailverifycode']);
Route::get('/auth', function () {return view('layouts.auth');});

Route::get('/mail', function () {
    Mail::to('ronnelardales2192@gmail.com')
    ->send(new HelloMail());
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


