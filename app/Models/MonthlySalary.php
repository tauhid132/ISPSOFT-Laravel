<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'monthly_salary',
        'pre_advance',
        'commission',
        'meal',
        'payment_by_id',
        'paid_salary',
        'payment_date',
        'month',
        'year'
    ];
    public function payment_by(){
        return $this->belongsTo(Admin::class,'payment_by_id','id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
