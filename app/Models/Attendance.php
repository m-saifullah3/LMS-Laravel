<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'date'
    ];

    protected $dates = [
        'date'
    ];

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    public function attendance_details() {
        return $this->hasMany(AttendanceDetails::class);
    }
}
