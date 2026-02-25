<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    // Create a new wallet for a user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name'    => 'required|string',
        ]);

        $wallet = Wallet::create($validated);

        return response()->json($wallet, 201);
    }

    // View a single wallet with its transactions and balance
    public function show($id)
    {
        $wallet = Wallet::with('transactions')->findOrFail($id);

        return response()->json([
            'id'           => $wallet->id,
            'name'         => $wallet->name,
            'balance'      => $wallet->balance,
            'transactions' => $wallet->transactions,
        ]);
    }
}
