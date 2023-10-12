<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class D2CMarketing extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'address',
        'mobile_no',
        'email_address',
        'package',
        'possibility',
        'status',
        'comment',
        'visited_by',
        'created_by',
    ];
}
