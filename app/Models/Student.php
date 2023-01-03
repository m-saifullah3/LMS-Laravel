<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification',
        'basic_computer_knowledge',
        'occupation',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function is_already_enrolled($course_id, $student_id, $batch_id) {
        $_SESSION['course_id'] = $course_id;
        $_SESSION['batch_id'] = $batch_id;
        $enrollments = $this->hasMany(Enrollment::class)->whereRelation('batch', function($query) {
            $query->where([
                'course_id' => $_SESSION['course_id'],
                'id' => $_SESSION['batch_id'],
            ]);
        })->where('student_id', $student_id)->get();
        return $enrollments;
    }
}
