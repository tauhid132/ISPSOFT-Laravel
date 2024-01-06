<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'created_by',
        'stock_type',
        'comment'
    ];
    public function created_by(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }
}
