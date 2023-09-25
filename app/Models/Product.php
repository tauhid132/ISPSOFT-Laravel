<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_type',
        'product_name',
        'status',
        'serial_no',
        'mac_address',
        'vendor',
        'buying_price',
        'buying_date',
        'warranty',
        'added_by',
        'used_in',
    ];
}
