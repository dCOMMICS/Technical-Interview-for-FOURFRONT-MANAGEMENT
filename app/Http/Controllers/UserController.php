<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Create a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // View user profile with wallets and balances
    public function show($id)
    {
        $user = User::with('wallets.transactions')->findOrFail($id);

        $wallets = $user->wallets->map(function ($wallet) {
            return [
                'id'      => $wallet->id,
                'name'    => $wallet->name,
                'balance' => $wallet->balance,
            ];
        });

        return response()->json([
            'id'            => $user->id,
            'name'          => $user->name,
            'email'         => $user->email,
            'wallets'       => $wallets,
            'total_balance' => $user->total_balance,
        ]);
    }
}
