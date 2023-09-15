<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
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
        'reseller_type',
        'address',
        'monthly_bill',
        'current_due',
    ];
}
