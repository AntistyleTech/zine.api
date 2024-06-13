<?php

declare(strict_types=1);

namespace App\Interfaces\Auth;

interface UserData
{
    public function id(): int;

    /* @return array<int, Role> */
    public function accounts(): array;
}
