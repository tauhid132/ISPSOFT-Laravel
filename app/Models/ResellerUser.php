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
        'status',
        'api_status',
        'api_server',
        'reseller_package_id',
        'price',
    ];

    public function package(){
        return $this->belongsTo(ResellerPackage::class,'reseller_package_id','id');
    }
}
