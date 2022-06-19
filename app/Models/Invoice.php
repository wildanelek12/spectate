<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function verificationTicket()
    {
        return $this->hasOne(VerificationTicket::class);
    }
}
