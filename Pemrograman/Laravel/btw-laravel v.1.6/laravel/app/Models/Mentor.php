<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    protected $table = 'mentors';
    protected $fillable = [
        'user_id',
        'name',
        'sex',
        'whatsapp',
        'address'
    ];
    public static $rules = [
        'user_id'=>'required|integer',
        'name'=>'required|string|max:255',
        'sex'=>'required|string|max:255',
        'whatsapp'=>'required|string|max:255',
        'address'=>'required|string|max:255',
    ];
}
