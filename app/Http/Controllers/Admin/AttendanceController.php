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
    public function index()
    {
        // You may want to pass a list of employees for a quick lookup.
        $employees = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.attendance.index', compact('employees'));
    }

    /**
     * Store a single attendance record.
     *
     * Expected payload:
     *   - rfid_uid (string, required)
     *   - fingerprint_template (string, optional)
     *
     * The client will send the raw UID and, if available, the base‑64
     * fingerprint template. The controller links the UID to the employee
     * (by `users.rfid_uid`) and stores the record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfid_uid' => ['required', 'string', 'max:32'],
            'fingerprint_template' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $user = User::where('rfid_uid', $request->rfid_uid)->first();

        // Determine Time In or Time Out
        $today = now()->toDateString();

        $lastScanToday = Attendance::where('rfid_uid', $request->rfid_uid)
            ->whereDate('scanned_at', $today)
            ->orderByDesc('scanned_at')
            ->first();

        // If no scan today OR last was time_out → time_in
        // If last was time_in → time_out
        $type = 'time_in';
        if ($lastScanToday && $lastScanToday->type === 'time_in') {
            $type = 'time_out';
        }

        Attendance::create([
            'user_id' => $user ? $user->id : null,
            'rfid_uid' => $request->rfid_uid,
            'type' => $type,
            'fingerprint_template' => $request->fingerprint_template,
            'scanned_at' => now(),
        ]);

        $employeeName = $user ? $user->name : 'Unknown';

        return response()->json([
            'status' => 'ok',
            'type' => $type,
            'employee' => $employeeName,
        ]);
    }
}
