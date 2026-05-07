<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'total_hours',
        'gross_pay',
        'sss',
        'philhealth',
        'pagibig',
        'tax',
        'total_deductions',
        'net_pay',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
