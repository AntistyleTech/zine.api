<?php

declare(strict_types=1);

namespace Modules\User\Enum;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum ContactType: string
{
    use HasEnumNames, HasEnumValues;

    case Email = 'Email';
    case Telegram = 'Telegram';
    case Github = 'Github';
}
