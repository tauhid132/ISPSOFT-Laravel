<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'reseller_id',
        'username',
        'password',
        'api_status',
        'api_server',
        'package',
        'price',
    ];
}
