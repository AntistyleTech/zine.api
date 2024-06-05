<?php

declare(strict_types=1);

namespace App\Contracts\Content\Enum;

enum Lang: string
{
    case English = 'English';
    case Spanish = 'Spanish';
    case Portuguese = 'Portuguese';
    case Russian = 'Russian';
}
