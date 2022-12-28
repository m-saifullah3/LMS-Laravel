<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'shift',
    ];
}
