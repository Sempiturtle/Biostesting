<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.users.create', ['fixedRole' => 'user']);
    }

    public function createAdmin()
    {
        return view('admin.users.create', ['fixedRole' => 'admin']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($user->role === 'user') {
            return redirect()
                ->route('admin.employees.attendance', $user)
                ->with('info', 'Now assign RFID and fingerprint.');
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'User created successfully.');
    }

    public function indexEmployees()
    {
        $employees = User::where('role', 'user')->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function indexAdmins()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],
            'role' => ['required', 'string', 'in:user,admin'],
            // ---- NEW ----
            'rfid_uid' => [
                'nullable',
                'string',
                'max:32',
                Rule::unique('users', 'rfid_uid')
                    ->ignore($user->id)
            ],
            'fingerprint_template' => ['nullable', 'string'],
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // NEW
            'rfid_uid' => $request->rfid_uid,
            'fingerprint_template' => $request->fingerprint_template,
        ]);
        // optional password override (you already have this)
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}