<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'username', 'password','profile_picture','email','role','status'
    ];
    public function notes(){
        return $this->hasMany(Note::class,'admin_id','id')->latest();
    }
    public function notifications(){
        return $this->hasMany(Notification::class,'receiver_id','id')->latest();
    }
}
