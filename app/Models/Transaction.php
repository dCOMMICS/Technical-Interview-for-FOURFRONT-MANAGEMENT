<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['wallet_id', 'description', 'amount', 'type'];

    // A transaction belongs to a wallet
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
