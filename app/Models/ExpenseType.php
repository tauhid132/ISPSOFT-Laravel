<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;
    public function getIndividualExpense($expense_type,$month,$year){
        return MonthlyExpense::where('expense_type_id',$expense_type)->where('expense_month',$month)->where('expense_year',$year)->sum('amount');
    }
}
