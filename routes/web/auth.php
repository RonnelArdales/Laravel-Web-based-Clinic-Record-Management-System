<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function() {

    //-----------search------------//

    Route::get('/diagnosis/filter/{year}', [SearchController::class, 'filter_diagnosis']);
    Route::get('/user/search-name', [SearchController::class, 'profile_search_user']);
    Route::get('/user/search-usertype', [SearchController::class, 'search_usertype']);
    Route::get('/appointment/search-name', [SearchController::class, 'appointment_search_user']);

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