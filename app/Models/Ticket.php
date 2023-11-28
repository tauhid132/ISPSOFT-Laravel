<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_type_id',
        'ticket_description',
        'created_by_id',
        'comment',
        'status',
        'priority',
        'start_processing_at',
        'start_processing_by_id',
        'closed_at',
        'closed_by_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function type(){
        return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
    public function assigned_executives(){
        return $this->belongsToMany(Employee::class, 'ticket_employee', 'ticket_id', 'employee_id');
    }
    public function created_by(){
        return $this->belongsTo(Admin::class,'created_by_id','id');
    }
    public function start_processing_by(){
        return $this->belongsTo(Admin::class,'start_processing_by_id','id');
    }
    public function closed_by(){
        return $this->belongsTo(Admin::class,'closed_by_id','id');
    }
    public function comments(){
        return $this->hasMany(TicketComment::class,'ticket_id','id')->latest();
    }

}
