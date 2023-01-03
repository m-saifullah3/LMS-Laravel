<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'class_shift_id',
        'teacher_id',
        'starting_date',
        'ending_date',
        'seats',
        'status',
    ];

    protected $dates = [
        'starting_date',
        'ending_date',
    ];


    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function class_shift() {
        return $this->belongsTo(ClassShift::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

}
