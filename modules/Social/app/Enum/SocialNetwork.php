<?php

declare(strict_types=1);

namespace Modules\Social\Enum;

use App\Enum\HasEnumNames;
use App\Enum\HasEnumValues;

enum SocialNetwork: string
{
    use HasEnumNames, HasEnumValues;

    case Tumblr = 'tumblr';
    case Twitter = 'twitter';
    case Reddit = 'reddit';
    case Telegram = 'telegram';
    case Pinterest = 'pinterest';
    case Flickr = 'flickr';
    case Discord = 'discord';
    case Instagram = 'instagram';
    case Facebook = 'facebook';
}
