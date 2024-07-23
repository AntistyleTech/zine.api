<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Modules\User\Exceptions\WrongCredentialsException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Models\User;
use Modules\User\Services\Commands\Login;
use Modules\User\Services\Commands\Register;
use Modules\User\Services\Data\ContactData;
use Modules\User\Services\UserAuthService;

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
            name: $validated['name'],
            contact: ContactData::email($validated['email']),
            password: $validated['password']
        );

        $user = $this->authService->register($register);

        return $user;
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): User
    {
        $login = Login::from($request->validated());

        return $this->authService->login($login);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }

    public function user(): JsonResponse
    {
        return response()->json(['user' => $this->authService->user()]);
    }
}
