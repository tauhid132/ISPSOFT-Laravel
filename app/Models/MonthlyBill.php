<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'monthly_bill',
        'due_bill',
        'paid_monthly_bill',
        'paid_due_bill',
        'payment_date',
        'payment_method',
        'received_by',
        'added_by',
        'comment',
        'trx_id',
        'billing_month',
        'billing_year',
        'is_last_month_unpaid',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
