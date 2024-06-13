<?php

declare(strict_types=1);

namespace App\Interfaces\Auth;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum Role: string
{
    use HasEnumNames, HasEnumValues;

    case Manager = 'Manager';
    case VerifiedUser = 'VerifiedUser';
    case User = 'User';
}
