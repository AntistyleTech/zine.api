<?php

declare(strict_types=1);

namespace App\Content\Services\Data\enum;

enum ContentStatus: string
{
    case Draft = 'Draft';
    case Hidden = 'Hidden';
    case Public = 'Public';
}
