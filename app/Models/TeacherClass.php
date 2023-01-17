<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'class_no',
        'topic',
        'description',
        'date',
        'tasks',
        'file',
    ];


    public function batch() {
        return $this->belongsTo(Batch::class);
    }
}
