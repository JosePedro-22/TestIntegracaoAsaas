<?php

namespace App\Http\Controllers;

use App\Http\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $auth_service;

    public function __construct(
        AuthService $auth_service
    ) {
        $this->auth_service = $auth_service;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return $this->auth_service->auth($credentials);

    }
}
