<?php

declare(strict_types=1);

namespace Modules\Social\Services\Tumblr\Oauth2;

use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;

class TumblrProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://www.tumblr.com/oauth2/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://api.tumblr.com/v2/oauth2/token';
    }

    public function getAccessToken(string $code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret)],
            'form_params' => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken(json_decode($response->getBody()->getContents(), true));
    }

    protected function getTokenFields($code): array
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()
            ->get('https://api.tumblr.com/v2/user/info', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);

        return json_decode($response->getBody()->getContents(), true)['response']['user'];
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['name'],
            'nickname' => $user['name'],
            'name' => $user['name'],
            'avatar' => $user['avatar'][0]['url'] ?? null,
        ]);
    }
}
