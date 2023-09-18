<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtherInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'on_account',
        'paid_amount',
        'payment_method',
        'payment_date',
        'received_by_id',
        'generated_by_id',
        'month',
        'year'
    ];
    public function generated_by(){
        return $this->belongsTo(Admin::class,'generated_by_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
