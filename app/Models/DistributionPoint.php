<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'distribution_point_name',
        'latitude',
        'longitude',
    ];
}
