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
        'reseller_user_package_id',
        'price',
    ];

    public function package(){
        return $this->belongsTo(ResellerUserPackage::class,'reseller_user_package_id','id');
    }
}
