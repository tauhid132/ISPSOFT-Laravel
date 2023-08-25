<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyDownstreamBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill',
        'due_bill',
        'paid_bill',
        'payment_date',
        'payment_by_id',
        'month',
        'year'
    ];
    public function payment_by(){
        return $this->belongsTo(Admin::class,'payment_by_id','id');
    }
    public function downstream(){
        return $this->belongsTo(Downstream::class,'downstream_id','id');
    }
}
