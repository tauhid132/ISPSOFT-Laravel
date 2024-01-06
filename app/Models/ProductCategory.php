<?php

namespace App\Models;

use App\Models\ProductStockIn;
use App\Models\ProductStockOut;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_category_name',
        'description',
    ];

    

    public function getTotalStockInAttribute()
    {
        $stock_ins = ProductStock::where('product_id', $this->id)->where('stock_type','stock-in')->sum('quantity');
        if($stock_ins != null){
            return $stock_ins;
        }else{
            return 0;
        }
        
    }
    public function getTotalStockOutAttribute()
    {
        $stock_outs = ProductStock::where('product_id', $this->id)->where('stock_type','stock-out')->sum('quantity');
        if($stock_outs != null){
            return $stock_outs;
        }else{
            return 0;
        }
        
    }
}
