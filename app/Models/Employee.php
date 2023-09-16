<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'username',
        'mobile_no',
        'email_address',
        'present_address',
        'permanent_address',
        'status',
        'position',
        'salary',
        'current_balance',
        'image',
        'joining_date'
    ];
}
