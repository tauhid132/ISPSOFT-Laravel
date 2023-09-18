<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayWithdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'year',
        'bkash_withdraw',
        'nagad_withdraw',
        'bank_withdraw',
        'ssl_commerz_withdraw',
    ];
}
