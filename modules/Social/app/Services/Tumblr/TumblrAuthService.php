<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr;

use Illuminate\Contracts\Session\Session;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

final readonly class TumblrAuthService
{
    private const oauthStateKey = 'tumblr:oauth2state';

    public function __construct(
        private AbstractProvider $provider,
        private Session $session
    ) {
    }

    public function auth(): string
    {
        $options = ['scope' => ['write']];

        $this->session->put(
            self::oauthStateKey,
            $this->provider->getState()
        );

        return $this->provider->getAuthorizationUrl($options);
    }

    public function authConfirmed(string $state, string $code): void
    {
        $savedState = $this->session->get(self::oauthStateKey);

        if ($state !== $savedState) {
            throw new \Exception('Invalid OAuth state');
        }

        $accessToken = $this->provider->getAccessToken(
            'authorization_code',
            ['code' => $code]
        );

        // save token
    }

    public function getUserInfo()
    {
        $tokenData = '{"token_type":"bearer","scope":"basic","id_token":false,"access_token":"aioREE6tV9a85peMtvxdy7TJi4IdtbBpnkXFabiyvubGcnjfiD","expires":1718008318}';
        $tokenData = json_decode($tokenData, true);

        $token = new AccessToken($tokenData);
        $resourceOwner = $this->provider->getResourceOwner($token);

        // return resource owner data
    }
}
