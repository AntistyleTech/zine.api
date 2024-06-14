<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use Illuminate\Contracts\Session\Session;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

final class TumblrAuthService
{
    private string $oauthStateKey = 'tumblr:oauth2state';

    public function __construct(
        private TumblrApi $api,
        private Session $session
    ) {
    }

    public function auth(): string
    {
        $options = ['scope' => ['write']];

        $url = $this->api->getAuthorizationUrl($options);

        $this->session->put(
            $this->oauthStateKey,
            $this->api->providerState()
        );

        return $url;
    }

    public function authConfirmed(string $state, string $code)
    {
        $savedState = $this->session->get($this->oauthStateKey);

        if ($state !== $savedState) {
            throw new \Exception('Invalid OAuth state');
        }

        $accessToken = $this->api->getAccessToken('authorization_code', $code);
        dd($accessToken->getToken());

        // save token
    }
}
