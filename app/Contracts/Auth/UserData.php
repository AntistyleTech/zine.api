<?php

declare(strict_types=1);

namespace App\Contracts\Auth;

interface UserData
{
    public function id(): int;

    //* @var <integer, Role>[] */
    public function accounts(): array;
}
