<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reseller extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'status',
        'name',
        'contact_person',
        'username',
        'password',
        'email_address',
        'mobile_no',
        'address',
        'monthly_bill',
        'current_due',
    ];
}
