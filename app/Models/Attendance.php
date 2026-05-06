<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rfid_uid',
        'type',
        'fingerprint_template',
        'scanned_at',
    ];

    public $timestamps = false;   // we store our own timestamp

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
