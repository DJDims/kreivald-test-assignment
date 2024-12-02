<?php

namespace App\Services;

use App\Models\Token;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TokenService
{
    public function generateToken()
    {
        $token = Str::random(255);
        $expiry  = Carbon::now()->addMinutes(40);
        Token::create([
            'token' => $token,
            'expires_at' => $expiry,
        ]);
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
