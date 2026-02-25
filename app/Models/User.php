<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email'];

    // A user has many wallets
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    // Calculate total balance across all wallets
    public function getTotalBalanceAttribute()
    {
        return $this->wallets->sum(fn($wallet) => $wallet->balance);
    }
}
