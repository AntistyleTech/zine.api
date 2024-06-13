<?php

namespace App\Interfaces\Auth;

interface AuthService
{
    public function user(): ?UserData;
}
