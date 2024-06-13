<?php

namespace App\Social\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;

class TumblrController
{
    private GenericProvider $provider;

    public function __construct()
    {
        $this->provider = new GenericProvider([
            'clientId' => '63mdOtFi04UG3K7EBH3UBZT9WANYXc1Q7MZ5TjMe569kol9GFo',
            'clientSecret' => 'FVk4JUqAeVSzoxG69vIOgo97QJIhuVv2uMldytUrNnTL4moxjR',
            'redirectUri' => 'https://7244-14-243-66-113.ngrok-free.app/api/social/tumblr/auth_confirmed', // Используется только в примере для auth URL
            'urlAuthorize' => 'https://www.tumblr.com/oauth2/authorize',
            'urlAccessToken' => 'https://api.tumblr.com/v2/oauth2/token',
            'urlResourceOwnerDetails' => 'https://api.tumblr.com/v2/user/info'
        ]);
    }

    public function auth()
    {
        Session::start(); // ??
        $options = [
            'scope' => ['write']
        ];
        $authorizationUrl = $this->provider->getAuthorizationUrl($options);
        Session::put('oauth2state', $this->provider->getState());
        return redirect($authorizationUrl);
    }

    public function authConfirmed(Request $request)
    {
        $request->validate([
            'state' => 'required',
            'code' => 'required'
        ]);

        $state = $request->get('state');
//        if ($state !== Session::get('oauth2state')) {
//            return response()->json(['error' => 'Invalid OAuth state'], 400);
//        }

        $code = $request->get('code');
        $accessToken = $this->provider->getAccessToken(
            'authorization_code',
            ['code' => $code]
        );

        // TODO: save token

        return response()->json($accessToken);
    }

    public function getUserInfo()
    {
        // TODO: get token by User
        $tokenData = '{"token_type":"bearer","scope":"basic","id_token":false,"access_token":"aioREE6tV9a85peMtvxdy7TJi4IdtbBpnkXFabiyvubGcnjfiD","expires":1718008318}';
        $tokenData = json_decode($tokenData, true);

        $token = new AccessToken($tokenData);
        $resourceOwner = $this->provider->getResourceOwner($token);

        return response()->json($resourceOwner->toArray());
    }

    public function sendPost(Request $request)
    {
        $tokenData = '{"token_type":"bearer","scope":"write","id_token":false,"access_token":"a7gxF6ydMkYszf3XMDkXINZhbC14Jya9BrVwplmBszKSte2xQr","expires":1718126911}';
        $tokenData = json_decode($tokenData, true);

        $token = new AccessToken($tokenData);
        $blogIdentifier = 'nstsmalinovskaa';
       //TODO: $token->hasExpired();

        $content = [
            "content" => [
                [
                    "type" => "image",
                    "media" => [
                        [
                            "type" => "image/jpeg",
                            "url" => "https://images.unsplash.com/photo-1718049720096-7f1af82d69af?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                            "width" => "1280",
                            "height" => "1073",
                        ]
                    ],
                ]
            ]

        ];

        $requestUrl = "https://api.tumblr.com/v2/blog/$blogIdentifier/posts";
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
            'json' => $content
        ];
        $client = new Client();
        try {
            // Отправляем POST запрос
            $response = $client->request('POST', $requestUrl, $options);

            // Возвращаем тело ответа
            return response()->json(json_decode($response->getBody()->getContents(), true));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Обработка ошибок клиента
            $responseBody = $e->getResponse()->getBody()->getContents();
            return response()->json(json_decode($responseBody, true), 400);
        } catch (\Throwable $t) {
            // Обработка других ошибок
            return response()->json(['error' => $t->getMessage()], 500);
        }

    }

}

