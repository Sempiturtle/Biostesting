# Admin Sidebar & Full CRUD Guide (Updated)

This guide includes the sidebar setup plus Edit and Delete functionality for Employees and Admins.

## 1. routes/web.php
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    
    // Lists
    Route::get('/employees', [UserController::class, 'indexEmployees'])->name('employees.index');
    Route::get('/administrators', [UserController::class, 'indexAdmins'])->name('admins.index');

    // Forms
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/administrators/create', [UserController::class, 'createAdmin'])->name('admins.create'); // Optional separate form
    
    // CRUD Actions
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
```

## 2. app/Http/Controllers/Admin/UserController.php
```php
public function indexEmployees() {
    $employees = User::where('role', 'user')->get();
    return view('admin.employees.index', compact('employees'));
}

public function indexAdmins() {
    $admins = User::where('role', 'admin')->get();
    return view('admin.admins.index', compact('admins'));
}

public function edit(User $user) {
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        'role' => ['required', 'string', 'in:user,admin'],
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->route('admin.dashboard')->with('success', 'Updated!');
}

public function destroy(User $user) {
    $user->delete();
    return back()->with('success', 'Deleted!');
}
```

## 3. resources/views/components/admin-sidebar.blade.php
(Paste the sidebar code here from previous turn)
