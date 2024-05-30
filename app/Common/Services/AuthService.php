<?php

namespace App\Common\Services;

interface AuthService
{
    public function user(): ?UserData;
}
