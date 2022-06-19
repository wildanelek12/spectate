<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_types');
    }
}
