<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AttendanceController;



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

//Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Users CRUD
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

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
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])
        ->name('attendance.store');

});


require __DIR__ . '/auth.php';