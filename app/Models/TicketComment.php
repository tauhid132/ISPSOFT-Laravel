<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'comment',
        'comment_by',
    ];
    public function commentor(){
        return $this->belongsTo(Admin::class,'comment_by','id');
    }
}
