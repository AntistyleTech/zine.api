<?php

declare(strict_types=1);

namespace Modules\Social\Enum;

enum SocialNetwork: string
{
    case Tumblr = 'Tumblr';
    case Twitter = 'Twitter';
    case Reddit = 'Reddit';
    case Telegram = 'Telegram';
    case Pinterest = 'Pinterest';
    case Flickr = 'Flickr';
    case Discord = 'Discord';
    case Instagram = 'Instagram';
    case Facebook = 'Facebook';
}
