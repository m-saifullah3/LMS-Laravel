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

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function classes() {
        return $this->hasMany(TeacherClass::class);
    }

    public static function is_already_batch_created($course_id, $teacher_id, $shift_id, $starting_date, $batch_id = false) {
        
        if($batch_id == false) {

            $batches = Batch::where([
                ['course_id', $course_id],
                ['teacher_id', $teacher_id],
                ['class_shift_id', $shift_id],
            ])->orWhere([
                ['course_id', $course_id],
                ['teacher_id', $teacher_id],
                ['starting_date', $starting_date],
            ])->get();

        } else {

            $batches = Batch::where([
                ['course_id', $course_id],
                ['teacher_id', $teacher_id],
                ['class_shift_id', $shift_id],
                ['id', '!=', $batch_id],
            ])->orWhere([
                ['course_id', $course_id],
                ['teacher_id', $teacher_id],
                ['starting_date', $starting_date],
                ['id', '!=', $batch_id],
            ])->get();
            
        }

        if (count($batches) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
