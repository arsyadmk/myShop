<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transactionDetail extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionDetailFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'transaction_id',
        'qty',
        'price',
        'total',
    ];

    public function transaction(): BelongsTo
    {
        return $this->BelongsTo(Transaction::class);
    }
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }
}
