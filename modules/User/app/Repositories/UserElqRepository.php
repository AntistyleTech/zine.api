<?php

declare(strict_types=1);

namespace Modules\User\Repositories;

use Modules\User\Domain\Repositories\UpdateUser;
use Modules\User\Domain\Repositories\UserRepository as UserRepositoryInterface;
use Modules\User\Models\User as UserElq;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Domain\Model\User;
use Modules\User\Domain\Repositories\CreateUser;
use Modules\User\Domain\Repositories\SearchUser;

final class UserElqRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        $user = UserElq::find($id);

        return $user ? User::from($user) : null;
    }

    public function create(CreateUser $create): ?User
    {
        $user = UserElq::create($create->toArray());

        return $user ? User::from($user) : null;
    }

    public function search(SearchUser $search): ?User
    {
        if (empty(array_filter($search->toArray()))) {
            return null;
        }

        $user = UserElq::when($search->id, fn(Builder $query) => $query->where('id', $search->id))
            ->when($search->email, fn(Builder $query) => $query->where('email', $search->email))
            ->when($search->username, fn(Builder $query) => $query->where('username', $search->username))
            ->first();

        return $user ? User::from($user) : null;
    }

    public function update(UpdateUser $update): User
    {
        throw new \Exception('err');
    }
}
