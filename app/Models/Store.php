<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
    ];
    
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function transaction(): HasMany
    {
        return $this->hasMany(transaction::class);
    }
}
