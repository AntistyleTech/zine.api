<?php

namespace App\Auth\Services;

use App\Auth\Services\Data\UserData;

interface AuthService
{
    public function user(): ?UserData;
}
