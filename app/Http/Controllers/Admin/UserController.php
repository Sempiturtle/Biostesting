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
            'rfid_uid' => ['nullable', 'string', 'max:32', 'unique:users'],
            'fingerprint_template' => ['nullable', 'string'],
            'schedule_file' => ['nullable', 'file', 'mimes:csv,txt'],
            'basic_salary' => ['nullable', 'numeric', 'min:0'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'basic_salary' => $validated['basic_salary'] ?? null,
            'hourly_rate' => $validated['hourly_rate'] ?? null,
            'rfid_uid' => $validated['rfid_uid'] ?? null,
            'fingerprint_template' => $validated['fingerprint_template'] ?? null,
        ]);

        // Handle Schedule Upload
        if ($request->hasFile('schedule_file')) {
            $file = fopen($request->file('schedule_file')->getRealPath(), 'r');
            fgetcsv($file); // Skip header

            while (($row = fgetcsv($file)) !== FALSE) {
                if (count($row) < 3) continue;
                $user->schedules()->create([
                    'day'        => $row[0],
                    'start_time' => date("H:i:s", strtotime($row[1])),
                    'end_time'   => date("H:i:s", strtotime($row[2])),
                ]);
            }
            fclose($file);
        }

        if ($user->role === 'user') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Employee and Schedule created successfully.');
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
            'rfid_uid' => [
                'nullable',
                'string',
                'max:32',
                Rule::unique('users', 'rfid_uid')->ignore($user->id)
            ],
            'fingerprint_template' => ['nullable', 'string'],
            'schedule_file' => ['nullable', 'file', 'mimes:csv,txt'],
            'basic_salary' => ['nullable', 'numeric', 'min:0'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'basic_salary' => $request->basic_salary,
            'hourly_rate' => $request->hourly_rate,
            'rfid_uid' => $request->rfid_uid,
            'fingerprint_template' => $request->fingerprint_template,
        ]);

        // Handle Schedule Update
        if ($request->hasFile('schedule_file')) {
            $user->schedules()->delete();

            $file = fopen($request->file('schedule_file')->getRealPath(), 'r');
            fgetcsv($file); // Skip header

            while (($row = fgetcsv($file)) !== FALSE) {
                if (count($row) < 3) continue;
                $user->schedules()->create([
                    'day'        => $row[0],
                    'start_time' => date("H:i:s", strtotime($row[1])),
                    'end_time'   => date("H:i:s", strtotime($row[2])),
                ]);
            }
            fclose($file);
        }

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