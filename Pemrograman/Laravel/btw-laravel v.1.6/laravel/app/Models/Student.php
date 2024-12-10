<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'user_id',
        'name',
        'sex',
        'classroom_id',
        'name_wali',
        'whatsapp_wali',
        'address',
        'whatsapp',
    ];
    public static $rules = [
        'user_id'=>'required|integer',
        'name'=>'required|string|max:255',
        'sex'=>'required|string|max:255',
        'classroom_id'=>'required|integer',
        'name_wali'=>'required|string|max:255',
        'whatsapp_wali'=>'required|string|max:255',
        'address'=>'required|string|max:255',
        'whatsapp'=>'required|string|max:255',
    ];
}
