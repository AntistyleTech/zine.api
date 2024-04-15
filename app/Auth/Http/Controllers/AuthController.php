<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\LoginRequest;
use App\Auth\Http\Requests\RegisterRequest;
use App\Auth\Repositories\Data\SearchUser;
use App\Auth\Services\AuthSessionService;
use App\Auth\Services\Data\Login;
use App\Auth\Services\Data\Register;
use App\Auth\Services\Data\UserData;
use App\Auth\Services\UserService;
use App\Controller;
use Exception;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthSessionService $authService,
        private readonly UserService $userService
    ) {
    }

    public function register(RegisterRequest $request): UserData
    {
        return $this->userService->register(Register::from($request->validated()));
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): UserData
    {
        $login = Login::from($request->validated());

        $this->authService->login($login);

        return $this->userService->search(SearchUser::from($login));
    }

    public function logout()
    {
        $this->authService->logout();
    }

    /**
     * @throws Exception
     */
    public function me(): UserData
    {
        $me = $this->authService->me();

        return $me ? UserData::from($me) : throw new \Exception('User not found');
    }
}
