<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerUserInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'reseller_user_id',
        'reseller_invoice_id',
        'bill',
    ];
}
