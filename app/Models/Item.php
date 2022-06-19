<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
