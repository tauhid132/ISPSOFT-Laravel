<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'module',
        'action_by',
    ];
    public function action_by(){
        return $this->belongsTo(Admin::class,'action_by','id');
    }
}
