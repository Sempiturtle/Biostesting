<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Show the real‑time detection page.
     */
    public function index(Request $request)
    {
        $recent = Attendance::orderByDesc('scanned_at')->take(10)->get();

        // If it's a refresh request from JS, only return the table
        if ($request->has('refresh')) {
            return view('admin.attendance.partials.table', compact('recent'))->render();
        }

        return view('admin.attendance.index', compact('recent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required',
            'schedule_file' => 'nullable|file|mimes:csv,txt'
        ]);

        // 1. Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 2. Handle Schedule Upload
        if ($request->hasFile('schedule_file')) {
            $path = $request->file('schedule_file')->getRealPath();
            $data = array_map('str_getcsv', file($path));

            // Remove header row
            $header = array_shift($data);

            foreach ($data as $row) {
                if (count($row) < 3)
                    continue;

                \App\Models\Schedule::create([
                    'user_id' => $user->id,
                    'day' => $row[0],
                    'start_time' => date("H:i:s", strtotime($row[1])),
                    'end_time' => date("H:i:s", strtotime($row[2])),
                ]);
            }
        }

        return redirect()->route('admin.employees.index')->with('success', 'Employee and Schedule uploaded successfully.');
    }


}
