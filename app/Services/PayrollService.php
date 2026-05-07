<?php

namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;

class PayrollService
{
    /**
     * Calculate payroll for a specific user and date range.
     */
    public function calculate($user, $startDate, $endDate)
    {
        // 1. Get all attendance for the period, ensuring they belong to the user
        $scans = Attendance::where('user_id', $user->id)
            ->whereBetween('scanned_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ])
            ->orderBy('scanned_at')
            ->get();

        $totalMinutes = 0;
        $lastIn = null;

        // 2. Pair Time-Ins with Time-Outs sequentially
        foreach ($scans as $scan) {
            if ($scan->type === 'time_in') {
                $lastIn = Carbon::parse($scan->scanned_at);
            } elseif ($scan->type === 'time_out' && $lastIn) {
                // Only calculate if we have a matching pair on the same day (standard practice)
                $outTime = Carbon::parse($scan->scanned_at);
                if ($lastIn->isSameDay($outTime)) {
                    $totalMinutes += $lastIn->diffInMinutes($outTime);
                }
                $lastIn = null; // Reset for next pair
            }
        }

        $totalHours = $totalMinutes / 60;
        $hourlyRate = $user->hourly_rate ?? 0;
        $grossPay = $totalHours * $hourlyRate;

        // Deductions Logic (PH Standards - Simplified)
        $sss = $grossPay * 0.045; // Approx 4.5%
        $philhealth = $grossPay * 0.02; // Approx 2%
        $pagibig = ($grossPay > 0) ? 100.00 : 0; // Fixed 100 if worked
        
        // Tax (Train Law Simplified: 0% if annual < 250k, approx 10% for this bracket)
        $tax = ($grossPay > 10000) ? ($grossPay * 0.10) : 0;

        $totalDeductions = $sss + $philhealth + $pagibig + $tax;
        $netPay = $grossPay - $totalDeductions;

        return [
            'total_hours'      => round($totalHours, 2),
            'gross_pay'        => round($grossPay, 2),
            'sss'              => round($sss, 2),
            'philhealth'       => round($philhealth, 2),
            'pagibig'          => round($pagibig, 2),
            'tax'              => round($tax, 2),
            'total_deductions' => round($totalDeductions, 2),
            'net_pay'          => round($netPay, 2),
        ];
    }
}
