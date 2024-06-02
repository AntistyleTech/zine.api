<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\User\Domain\Model\User;
use App\User\Domain\Repositories\UserRepository as UserRepositoryInterface;
use App\User\Models\User as UserElq;
use Illuminate\Database\Eloquent\Builder;

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
}
