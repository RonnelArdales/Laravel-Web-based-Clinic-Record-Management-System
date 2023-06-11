<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use Spatie\DbDumper\Databases\MySql;
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

Route::get('/previous-page', function () {
    return redirect()->back();
})->name('previous.page');

Route::get('/backup-database', function () {

// Database connection details
$databaseHost = env('DB_HOST');
$databasePort = env('DB_PORT');
$databaseName = env('DB_DATABASE');
$databaseUser = env('DB_USERNAME');
$databasePassword = env('DB_PASSWORD');

// Create a MySQLi connection
$mysqli = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);

// Check for connection errors
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Retrieve all tables in the database
$tables = array();
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

// Create backup file
$backupPath = public_path('/backup.sql');
$backupFile = fopen($backupPath, 'w');

// Iterate over tables and write SQL queries to the backup file
foreach ($tables as $table) {
    $result = $mysqli->query("SELECT * FROM $table");
    $numColumns = $result->field_count;

    fwrite($backupFile, "DROP TABLE IF EXISTS $table;\n");
    $createTableQuery = $mysqli->query("SHOW CREATE TABLE $table");
    $createTable = $createTableQuery->fetch_assoc();
    fwrite($backupFile, $createTable['Create Table'] . ";\n");

    while ($row = $result->fetch_array()) {
        $rowValues = array();
        for ($i = 0; $i < $numColumns; $i++) {
            $rowValues[] = "'" . $mysqli->real_escape_string($row[$i]) . "'";
        }
        fwrite($backupFile, "INSERT INTO $table VALUES (" . implode(',', $rowValues) . ");\n");
    }

    fwrite($backupFile, "\n");
}

// Close the backup file and database connection
fclose($backupFile);
$mysqli->close();

// Download the backup file
return response()->download($backupPath)->deleteFileAfterSend(true);


});


//unverified email
Route::get('/verify-email-auth', [AuthController::class, 'verifyemail_auth'])->middleware('auth'); 
Route::get('/resend/auth', [AuthController::class, 'resendcode_verify'])->middleware('auth') ; 

//verify email register
Route::get('/verify-email', [AuthController::class, 'verifyemail']); //show find email
Route::get('/resendCode/create/{email}', [AuthController::class, 'resend_code_create']);
Route::post('/verifyconfirm', [AuthController::class, 'emailverifycode']);












