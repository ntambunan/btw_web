<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';
    protected $fillable = [
        'name',
        'mentor_id',
        'is_active',
        'is_locked',
    ];
    public static $rules = [
        'name'=>'required|string',
        'mentor_id'=>'required|integer',
        'is_active'=>'required|integer',
        'is_locked'=>'required|integer',
    ];
}
