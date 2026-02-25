<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Add a transaction to a wallet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wallet_id'   => 'required|exists:wallets,id',
            'description' => 'required|string',
            'amount'      => 'required|numeric|min:0.01',
            'type'        => 'required|in:income,expense',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json($transaction, 201);
    }
}
