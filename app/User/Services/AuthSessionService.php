<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Exceptions\WrongCredentialsException;
use App\Auth\Exceptions\WrongGuardException;
use App\Auth\Services\Data\Login;
use App\Common\Services\UserData;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Session\Session;

final readonly class AuthSessionService implements AuthService
{
    /**
     * @throws WrongGuardException
     */
    public function __construct(
        private Guard $auth,
        private Session $session,
    ) {
        if (!$this->auth instanceof StatefulGuard) {
            throw new WrongGuardException(
                expected: StatefulGuard::class,
                provided: $this->auth::class
            );
        }
    }

    /**
     * @throws WrongCredentialsException
     */
    public function login(Login $login): true
    {
        $credentials = array_filter($login->toArray());

        $this->auth->attempt($credentials)
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

    public function user(): ?UserData
    {
        return UserData::from($this->me());
    }

    public function me(): ?Authenticatable
    {
        return $this->auth->user();
    }
}
