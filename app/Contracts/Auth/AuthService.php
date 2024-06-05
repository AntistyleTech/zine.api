<?php

namespace App\Contracts\Auth;

interface AuthService
{
    public function user(): ?UserData;
}
