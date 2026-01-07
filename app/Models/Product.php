<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'store_id',
    ];
    
    public function store(): BelongsTo
    {
        return $this->BelongsTo(Store::class);
    }
    
    public function transaction_detail(): HasMany
    {
        return $this->hasMany(transactionDetail::class);
    }
}
