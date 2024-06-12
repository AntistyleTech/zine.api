<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use League\OAuth2\Client\Token\AccessToken;
use Modules\Social\Services\Tumblr\TumblrAuthService;
use Modules\Social\Services\Tumblr\TumblrService;

class TumblrController extends Controller
{
    public function __construct(
        private TumblrService $tumblrService,
        private TumblrAuthService $tumblrAuthService
    ) {
    }

    public function auth(): RedirectResponse
    {
        $authorizationUrl = $this->tumblrAuthService->auth();

        return redirect($authorizationUrl);
    }

    public function authConfirmed(Request $request)
    {
        $request->validate([
            'state' => 'required|string',
            'code' => 'required|string'
        ]);

        $state = $request->get('state');
        $code = $request->get('code');

        $this->tumblrAuthService->authConfirmed($code, $state);

        return response('', 201);
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

        $token = (new AccessToken($tokenData));
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
                'Authorization' => 'Bearer '.$token,
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
