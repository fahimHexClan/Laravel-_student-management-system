<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    // Mass assignment-க்கு allow பண்ற fields
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'course'
    ];
}