<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['firstName', 'lastName', 'email'];
    protected $table = 'students';
    use HasFactory;
}
