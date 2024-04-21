<?php

declare(strict_types=1);

namespace App\Content\Services;

enum ContentItemType: string
{
    case Text = 'Text';
    case MarcDown = 'MarcDown';
    case NuxtContent = 'NuxtContent';
    case Image = 'Image';
    case Html = 'Html';
}
