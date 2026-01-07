<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $fillable = [
        'store_id',
        'grand_total',
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
