<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\MonthlyBill;
use App\Models\ServiceArea;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'customer_name',
        'contact_person',
        'connection_address',
        'billing_address',
        'mobile_no',
        'mobile_no_alternate',
        'email_address',
        'nid_passport',
        'zone_id',
        'sub_zone_id',
        'installation_date',
        'customer_type',
        'package_id',
        'physical_connectivity_type',
        'logical_connectivity_type',
        'ip_address',
        'onu_mac',
        'fiber_code',
        'distribution_point',
        'monthly_bill',
        'current_due',
        'billing_cycle',
        'expiry_day',
        'expiry_date',
        'sales_method',
        'sales_person',
        'status',
        'api_status',
        'api_server',
        'send_sms',
        'send_email',
        'print_invoice',
        'auto_disconnect',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function bills(){
        return $this->hasMany(MonthlyBill::class,'user_id','id');
    }
    public function tickets(){
        return $this->hasMany(Ticket::class,'user_id','id');
    }
    public function package(){
        return $this->belongsTo(Package::class,'package_id','id');
    }
    public function server(){
        return $this->belongsTo(Mikrotik::class,'api_server','id');
    }

   

}
