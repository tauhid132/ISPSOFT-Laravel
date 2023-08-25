<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\ExpenseType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_type_id',
        'description',
        'amount',
        'expense_by',
        'expense_date',
        'expense_month',
        'expense_year',
        'added_by'
    ];
    public function type(){
        return $this->belongsTo(ExpenseType::class,'expense_type_id','id');
    }
    public function expenseByEmployee(){
        return $this->belongsTo(Employee::class,'expense_by','id');
    }
    public function addedBy(){
        return $this->belongsTo(Admin::class,'added_by','id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
}
