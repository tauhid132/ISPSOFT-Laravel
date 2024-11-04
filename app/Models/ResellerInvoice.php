<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'reseller_id',
        'monthly_bill',
        'due_bill',
        'paid_monthly_bill',
        'paid_due_bill',
        'payment_date',
        'payment_method',
        'received_by',
        'billing_month',
        'billing_year',
    ];

    public function reseller(){
        return $this->belongsTo(Reseller::class);
    }
}
