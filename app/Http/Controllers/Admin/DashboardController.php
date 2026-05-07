<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Services\ReliefService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with real-time stats.
     */
    public function index(ReliefService $reliefService)
    {
        $stats = [
            'totalEmployees' => User::where('role', 'user')->count(),
            'presentToday' => Attendance::whereDate('scanned_at', Carbon::today())
                ->where('type', 'time_in')
                ->distinct('user_id')
                ->count(),
            'pendingPayrolls' => Payroll::where('status', 'pending')->count(),
            'absentNow' => count($reliefService->getAbsentProfessors()),
        ];

        $recentUsers = User::orderByDesc('created_at')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }
}
