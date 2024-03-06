<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    protected $guarded = [];



    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'sale_products')
            ->withPivot('quantity');
    }

}
