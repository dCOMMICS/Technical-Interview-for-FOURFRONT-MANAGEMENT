<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'name'];

    // A wallet belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A wallet has many transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Calculate wallet balance from transactions
    public function getBalanceAttribute()
    {
        $income = $this->transactions->where('type', 'income')->sum('amount');
        $expense = $this->transactions->where('type', 'expense')->sum('amount');
        return $income - $expense;
    }
}
