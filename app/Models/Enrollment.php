<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'student_id',
        'reg_no',
    ];


    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function batch() {
        return $this->belongsTo(Batch::class);
    }

    

}
