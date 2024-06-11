<?php

declare(strict_types=1);

namespace App\Contracts\Content\Enum;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum Lang: string
{
    use HasEnumNames, HasEnumValues;

    case English = 'English';
    case Spanish = 'Spanish';
    case Portuguese = 'Portuguese';
    case Russian = 'Russian';
}
