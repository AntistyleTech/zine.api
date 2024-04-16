<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Exceptions\WrongCredentialsException;
use App\Auth\Services\Data\Login;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Session\Session;

final readonly class AuthSessionService
{
    // TODO: add socialite auth
    public function __construct(
        private AuthManager $auth,
        private Session $session,
    ) {
    }

    /**
     * @throws Exception
     */
    public function login(Login $login): true
    {
        $credentials = array_filter($login->toArray());

        $this->auth->guard()->attempt($credentials)
            ? $this->session->regenerate()
            : throw new WrongCredentialsException();

        return true;
    }

    public function logout(): void
    {
        $this->auth->logout();
        $this->session->invalidate();
        $this->session->regenerateToken();
    }

    public function me(): ?Authenticatable
    {
        return $this->auth->user();
    }
}
