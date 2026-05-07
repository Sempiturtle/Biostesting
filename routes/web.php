<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\PayrollController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', fn() => view('welcome'));

// Auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('/users', UserController::class)->except(['index', 'show', 'create']);

    // Employees
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [UserController::class, 'indexEmployees'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/{user}/attendance', [UserController::class, 'attendanceForm'])->name('attendance');
        Route::post('/{user}/attendance', [UserController::class, 'attendanceStore'])->name('attendance.store');
    });

    // Administrators
    Route::prefix('administrators')->name('admins.')->group(function () {
        Route::get('/', [UserController::class, 'indexAdmins'])->name('index');
        Route::get('/create', [UserController::class, 'createAdmin'])->name('create');
    });

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    // Payroll
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::post('/payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate');
    Route::get('/payroll/{payroll}/download', [PayrollController::class, 'download'])->name('payroll.download');
    Route::patch('/payroll/{payroll}/paid', [PayrollController::class, 'markAsPaid'])->name('payroll.paid');

    // Relief Intelligence
    Route::get('/relief', [\App\Http\Controllers\Admin\ReliefController::class, 'index'])->name('relief.index');

});

require __DIR__ . '/auth.php';