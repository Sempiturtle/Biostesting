<?php

use App\Http\Controllers\Admin\AttendanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes  –  no CSRF, no session
|--------------------------------------------------------------------------
| These routes are used by the ESP32 attendance terminal.
| The ESP32 sends a JSON POST with rfid_uid and fingerprint_template.
|
| URL:  POST  http://<your-ip>:8000/api/attendance
|
*/

Route::post('/attendance', [AttendanceController::class, 'store']);
