<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #1e293b; }
        .header p { margin: 5px 0; font-size: 12px; color: #64748b; }
        
        .info-grid { width: 100%; margin-bottom: 30px; }
        .info-grid td { padding: 5px 0; font-size: 14px; }
        .label { font-weight: bold; color: #64748b; width: 150px; }
        
        .table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table th { background: #f1f5f9; padding: 10px; text-align: left; font-size: 12px; text-transform: uppercase; border: 1px solid #e2e8f0; }
        .table td { padding: 10px; border: 1px solid #e2e8f0; font-size: 14px; }
        
        .totals { float: right; width: 250px; }
        .totals-row { display: flex; justify-content: space-between; padding: 5px 0; }
        .totals-row.grand { border-top: 2px solid #333; margin-top: 10px; padding-top: 10px; font-weight: bold; font-size: 18px; }
        
        .footer { margin-top: 100px; font-size: 10px; text-align: center; color: #94a3b8; }
        .signature { margin-top: 50px; border-top: 1px solid #333; width: 200px; text-align: center; padding-top: 5px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>AISAT PAYROLL SYSTEM</h1>
        <p>Institutional Employee Payslip</p>
    </div>

    <table class="info-grid">
        <tr>
            <td class="label">Employee Name:</td>
            <td>{{ $payroll->user->name }}</td>
            <td class="label">Pay Period:</td>
            <td>{{ \Carbon\Carbon::parse($payroll->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($payroll->end_date)->format('M d, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Employee Email:</td>
            <td>{{ $payroll->user->email }}</td>
            <td class="label">Date Issued:</td>
            <td>{{ now()->format('M d, Y') }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Details</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Basic Salary Earnings</td>
                <td>{{ $payroll->total_hours }} Hours worked @ ₱{{ number_format($payroll->user->hourly_rate, 2) }}/hr</td>
                <td>₱{{ number_format($payroll->gross_pay, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; font-weight: bold;">GROSS PAY</td>
                <td style="font-weight: bold;">₱{{ number_format($payroll->gross_pay, 2) }}</td>
            </tr>
            <tr style="background: #fffafa;">
                <td>SSS Contribution</td>
                <td>Automated Deduction</td>
                <td style="color: red;">-₱{{ number_format($payroll->sss, 2) }}</td>
            </tr>
            <tr style="background: #fffafa;">
                <td>PhilHealth</td>
                <td>Automated Deduction</td>
                <td style="color: red;">-₱{{ number_format($payroll->philhealth, 2) }}</td>
            </tr>
            <tr style="background: #fffafa;">
                <td>Pag-IBIG</td>
                <td>Fixed Contribution</td>
                <td style="color: red;">-₱{{ number_format($payroll->pagibig, 2) }}</td>
            </tr>
            <tr style="background: #fffafa;">
                <td>Withholding Tax</td>
                <td>Income Tax</td>
                <td style="color: red;">-₱{{ number_format($payroll->tax, 2) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; font-weight: bold;">TOTAL DEDUCTIONS</td>
                <td style="font-weight: bold; color: red;">-₱{{ number_format($payroll->total_deductions, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="float: right;">
        <table style="width: 300px;">
            <tr>
                <td style="font-size: 18px; font-weight: bold;">NET TAKE HOME:</td>
                <td style="font-size: 24px; font-weight: bold; text-align: right; color: #166534;">₱{{ number_format($payroll->net_pay, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="signature">
        Administrator Signature
    </div>

    <div class="footer">
        This is a computer-generated payslip. No signature is required for verification.
        <br>AISAT Payroll Intelligence Engine v2.0
    </div>
</body>
</html>
