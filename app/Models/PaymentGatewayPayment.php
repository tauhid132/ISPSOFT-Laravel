<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'marchant_name',
        'payment_method',
        'invoice_id',
        'amount',
        'payment_timestamp',
        'trx_id',
    ];

    public function invoice(){
        return $this->belongsTo(MonthlyBill::class,'invoice_id','id');
    }
}
