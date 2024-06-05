<?php

declare(strict_types=1);

namespace App\Contracts\Content\Enum;

enum ContentStatus: string
{
    case Draft = 'Draft';
    case Hidden = 'Hidden';
    case Public = 'Public';
}
