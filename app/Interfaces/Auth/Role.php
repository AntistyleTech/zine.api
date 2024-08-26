<?php

declare(strict_types=1);

namespace App\Interfaces\Auth;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum Role: string
{
    use HasEnumNames, HasEnumValues;

    case Admin = 'admin';
    case Manager = 'manager';
    case VerifiedUser = 'verifiedUser';
    case User = 'user';
    case Guest = 'guest';
}
