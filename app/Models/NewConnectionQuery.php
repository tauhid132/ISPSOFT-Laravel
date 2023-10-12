<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewConnectionQuery extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'address',
        'mobile_no',
        'email_address',
        'package',
        'status',
        'comment',
        'query_medium',
        'created_by',
    ];
}
