<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\LoginRequest;
use App\Auth\Http\Requests\LogoutRequest;
use App\Auth\Http\Requests\MeRequest;
use App\Auth\Http\Requests\RegisterRequest;
use App\Controller;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return ['register'];
    }

    public function login(LoginRequest $request)
    {
        return ['login'];
    }

    public function logout(LogoutRequest $request)
    {
        return ['logout'];
    }

    public function me(MeRequest $request)
    {
        return ['me'];
    }
}
