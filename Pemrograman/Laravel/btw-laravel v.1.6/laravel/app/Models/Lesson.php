<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lessons';
    protected $fillable = ['classroom_id', 'date'];
    public static $rules = [
        'classroom_id' => 'required|integer',
        'date' => 'required|date'
    ];
}
