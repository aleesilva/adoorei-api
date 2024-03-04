<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $casts = [
        'products'     => 'array',
        'cancelled_at' => 'datetime',
    ];

    protected $guarded = [];
}
