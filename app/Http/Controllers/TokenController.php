<?php

namespace App\Http\Controllers;

use App\Services\TokenService;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    private TokenService $service;

    public function __construct(TokenService $service)
    {
        $this->service = $service;
    }

    public function generateToken()
    {
        return $this->service->generateToken();
    }
}
