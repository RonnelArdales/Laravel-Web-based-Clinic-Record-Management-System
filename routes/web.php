<?php

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

require __DIR__ . '/web/admin.php';

require __DIR__ . '/web/secretary.php';

require __DIR__ . '/web/patient.php';

require __DIR__ . '/web/guest.php';

require __DIR__ . '/web/auth.php';

require __DIR__ . '/web/forgotpassword.php';


















