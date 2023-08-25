<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'left_date',
        'left_reason',
        'left_reason_details',
        'user_id'
    ];
}
