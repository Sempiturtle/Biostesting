<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
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

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // 1. Employee Routes
    Route::get('/employees', [UserController::class, 'indexEmployees'])->name('employees.index');
    Route::get('/employees/create', [UserController::class, 'create'])->name('employees.create');

    // 2. Admin Routes
    Route::get('/administrators', [UserController::class, 'indexAdmins'])->name('admins.index');
    Route::get('/administrators/create', [UserController::class, 'createAdmin'])->name('admins.create');

    // CRUD
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});



require __DIR__ . '/auth.php';