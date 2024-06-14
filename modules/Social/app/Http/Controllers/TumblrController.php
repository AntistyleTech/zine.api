<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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

    public function user(): JsonResponse
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
        $this->tumblrService->posts();
    }
}
