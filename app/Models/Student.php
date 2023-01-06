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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function is_already_enrolled($course_id, $student_id, $batch_id)
    {

        $batch = Batch::find($batch_id);

        $enrollments = $this->enrollments()->whereRelation(
            'batch',
            fn ($query) => $query->where([
                'course_id' => $course_id,
            ])->orWhere([
                'id' => $batch_id,
            ])->orWhere([
                'course_id' => $batch->course_id
            ])
        )->where('id', $student_id)->get();

        dd ($enrollments);
        if(count($enrollments) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
