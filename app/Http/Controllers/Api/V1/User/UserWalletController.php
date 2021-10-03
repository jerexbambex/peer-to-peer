<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wallets\WalletResource;
use Illuminate\Http\Request;

class UserWalletController extends Controller
{
    public function index()
    {
        return new WalletResource(request()->user());
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric']
        ]);

        $request->user()->deposit($request->amount);

        return $this->myJson("Success", "{$request->amount} added Successfully", "202", new WalletResource(request()->user()));
    }
}
