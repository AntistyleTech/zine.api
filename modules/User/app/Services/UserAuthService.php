<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Session\Session;
use Modules\User\Exceptions\WrongCredentialsException;
use Modules\User\Exceptions\WrongGuardException;
use Modules\User\Models\User;
use Modules\User\Services\Commands\CreateUser;
use Modules\User\Services\Commands\Login;
use Modules\User\Services\Commands\Register;
use Modules\User\Services\Commands\SearchUser;
use Modules\User\Services\Data\ContactData;

final readonly class UserAuthService
{
    /**
     * @throws WrongGuardException
     */
    public function __construct(
        private Guard $auth,
        private Session $session,
        private UserService $userService
    ) {
        if (!$this->auth instanceof StatefulGuard) {
            throw new WrongGuardException(
                expected: StatefulGuard::class,
                provided: $this->auth::class
            );
        }
    }

    public function register(Register $register): User
    {
        $user = $this->userService->create(new CreateUser(
            name: $register->name,
            contact: $register->contact,
            password: $register->password
        ));

        return $user;
    }

    /**
     * @throws WrongCredentialsException
     */
    public function login(Login $login): User
    {
        $user = $this->userService->search(new SearchUser(name: $login->login))
            ?? $this->userService->search(new SearchUser(contact: ContactData::email($login->login)))
            ?? throw new WrongCredentialsException();

        $this->auth->attempt(['name' => $user->name, 'password' => $login->password])
            ? $this->session->regenerate()
            : throw new WrongCredentialsException();

        return $user;
    }

    public function logout(): void
    {
        $this->auth->logout();
        $this->session->invalidate();
        $this->session->regenerateToken();
    }

    public function user(): ?Authenticatable
    {
        return $this->auth->user();
    }
}
