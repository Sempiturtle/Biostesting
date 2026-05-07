<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payroll;
use App\Services\PayrollService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    /**
     * Download a PDF payslip for a specific payroll record.
     */
    public function download(Payroll $payroll)
    {
        $payroll->load('user');
        
        $pdf = Pdf::loadView('admin.payroll.payslip', compact('payroll'));
        
        return $pdf->download('payslip-' . $payroll->user->name . '-' . $payroll->start_date . '.pdf');
    }

    /**
     * Display a listing of generated payrolls.
     */
    public function index()
    {
        $payrolls = Payroll::with('user')->orderByDesc('start_date')->get();
        return view('admin.payroll.index', compact('payrolls'));
    }

    /**
     * Generate payroll for all employees within a date range.
     */
    public function generate(Request $request, PayrollService $service)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $employees = User::where('role', 'user')->get();

        if ($employees->isEmpty()) {
            return back()->with('error', 'No employees found to generate payroll for.');
        }

        foreach ($employees as $emp) {
            $calculation = $service->calculate($emp, $request->start_date, $request->end_date);

            // Update existing or create new payroll record for this period
            Payroll::updateOrCreate(
                [
                    'user_id' => $emp->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ],
                [
                    'total_hours' => $calculation['total_hours'],
                    'gross_pay' => $calculation['gross_pay'],
                    'net_pay' => $calculation['net_pay'],
                    'status' => 'pending'
                ]
            );
        }

        return redirect()->route('admin.payroll.index')
            ->with('success', 'Payroll generated successfully for all employees.');
    }

    /**
     * Mark a payroll as paid.
     */
    public function markAsPaid(Payroll $payroll)
    {
        $payroll->update(['status' => 'paid']);
        return back()->with('success', 'Payroll marked as paid.');
    }
}
