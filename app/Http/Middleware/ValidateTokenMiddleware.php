<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Services\TokenService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateTokenMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('token')) return response()->json([
            'success' => false,
            'message' => 'Token not provided.'
        ], 400);

        $token = Token::where('token', $request->header('token'))
            ->where('expires_at', '>', Carbon::now())
            ->where('is_used', false)
            ->first();

        if (!$token) return response()->json([
            'success' => false,
            'message' => 'The token expired',
        ], 401);

        $token->delete();

        return $next($request);
    }
}
