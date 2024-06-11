<?php

declare(strict_types=1);

namespace App\Contracts\Auth;

Interface UserData
{
    public function id(): int;
    //* @var <integer, Role>[] */
    public function accounts(): array;
}
