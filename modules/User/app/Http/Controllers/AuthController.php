<?php

namespace Modules\User\Http\Controllers;

use App\Contracts\Auth\UserData;
use App\Http\Controllers\Controller;
use Exception;
use Modules\User\app\Http\Requests\LoginRequest;
use Modules\User\app\Http\Requests\RegisterRequest;
use Modules\User\Domain\Repositories\SearchUser;
use Services\AuthSessionService;
use Services\Data\Login;
use Services\Data\Register;
use Services\UserService;

class AuthController extends Controller
{
    // TODO: add socialite auth

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

        return $me ? UserData::from($me) : throw new Exception('User not found');
    }
}
