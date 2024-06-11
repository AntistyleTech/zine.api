<?php

declare(strict_types=1);

namespace App\Contracts\Content\Enum;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum ContentItemType: string
{
    use HasEnumNames, HasEnumValues;

    case Text = 'Text';
    case Markdown = 'Markdown';
    case Html = 'Html';
    case NuxtContent = 'NuxtContent';
    case Image = 'Image';
}
