<?php

declare(strict_types=1);

namespace Modules\Social\Enum;

enum SocialNetwork: string
{
    case Tumblr = 'Tumblr';
    case Telegram = 'Telegram';
    case Pinterest = 'Pinterest';
    case Flickr = 'Flickr';
    case Twitter = 'Twitter';
    case Discord = 'Discord';
    case Instagram = 'Instagram';
    case Facebook = 'Facebook';
}
