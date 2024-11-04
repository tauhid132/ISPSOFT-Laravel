<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerUserPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_name',
        'package_bandwidth',
        'bill',
    ];
    
}
