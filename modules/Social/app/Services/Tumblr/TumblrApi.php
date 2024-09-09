<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use GuzzleHttp\Client;
use Modules\User\Models\Account;

final class TumblrApi
{
    private Client $client;

    public function __construct(Account $account)
    {
        $this->client = new Client();
    }

    public function posts()
    {

    }
}
