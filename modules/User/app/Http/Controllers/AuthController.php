<?php

namespace Modules\User\Http\Controllers;

use App\Contracts\Auth\UserData;
use App\Http\Controllers\Controller;
use Exception;
use Modules\User\Exceptions\WrongCredentialsException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Models\User;
use Modules\User\Services\Data\ContactData;
use Modules\User\Services\UserAuthService;
use Modules\User\Services\Commands\Login;
use Modules\User\Services\Commands\Register;
use Modules\User\Services\UserService;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserAuthService $authService
    ) {
    }

    /**
     * @throws WrongCredentialsException
     * @throws Exception
     */
    public function register(RegisterRequest $request): User
    {
        $validated = $request->validated();

        $register = new Register(
            name: $validated['username'],
            contact: ContactData::email($validated['email']),
            password: $validated['password']
        );

        $user = $this->authService->register($register);

        return $user;
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): UserData
    {
        $login = Login::from($request->validated());

        return $this->authService->login($login);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function user()
    {
        return $this->authService->user();
    }
}
