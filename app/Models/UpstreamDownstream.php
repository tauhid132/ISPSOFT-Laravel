<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpstreamDownstream extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'usage_description',
        'bill',
        'current_account',
        'status'
    ];
}
