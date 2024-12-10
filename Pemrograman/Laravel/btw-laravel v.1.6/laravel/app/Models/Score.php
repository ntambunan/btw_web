<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';
    protected $fillable = [
        'lesson_id',
        'student_id',
        'is_present',
        's_run',
        's_pushup',
        's_pullup',
        's_situp',
        's_shuttle',
    ];
    public static $rules = [
        'lesson_id'=>'required|integer',
        'student_id'=>'required|integer',
        'is_present'=>'required|integer',
        's_run'=>'required|integer',
        's_pushup'=>'required|integer',
        's_pullup'=>'required|integer',
        's_situp'=>'required|integer',
        's_shuttle'=>'required|integer',
    ];
}
