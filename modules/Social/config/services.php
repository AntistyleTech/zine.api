<?php

use Modules\Social\Enum\SocialNetwork;

return [
    'tunnelDomain' => env('TUNNEL_DOMAIN'),

    'tumblrApp' => [
        'clientId' => env('TUMBLR_APP_CLIENT_ID'),
        'clientSecret' => env('TUMBLR_APP_CLIENT_SECRET')
    ],
];
