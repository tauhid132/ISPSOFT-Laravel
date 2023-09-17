<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyUpstreamDownstreamBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'upstream_downstream_id',
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
    public function upstream_downstream(){
        return $this->belongsTo(UpstreamDownstream::class,'upstream_downstream_id','id');
    }
}
