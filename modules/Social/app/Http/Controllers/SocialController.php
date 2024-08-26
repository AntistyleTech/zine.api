<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Modules\Social\Enum\SocialNetwork;
use Modules\Social\Services\SocialService;
use Modules\Social\Services\Tumblr\TumblrService;

class SocialController extends Controller
{
    public function __construct(private SocialService $socialService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountId = Auth::user()->accounts->firstOrFail()->id;

        return Response::json($this->socialService->getAccounts($accountId));
    }

    public function available()
    {
        return Response::json($this->socialService->getAvailable());
    }

    public function auth(string $social): RedirectResponse
    {
        $social = SocialNetwork::from($social);

        return Socialite::driver($social->value)
            ->scopes(['basic', 'write'])
            ->redirect();
    }

    public function authConfirmed(Request $request, string $social)
    {
        $social = SocialNetwork::from($social);
        $accountId = Auth::user()->accounts->firstOrFail()->id;
        $socialUser = Socialite::driver($social->value)->user();

        $socialAccount = $this->socialService->createAccount(
            $accountId,
            $social,
            $socialUser->token,
            $socialUser->user
        );

        return Response::json($socialAccount, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('social::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('social::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('social::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
