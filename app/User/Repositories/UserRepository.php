<?php

declare(strict_types=1);

namespace App\User\Repositories;

use App\User\Models\User;
use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\Common\Services\UserData;
use Illuminate\Database\Eloquent\Builder;

final class UserRepository
{
    public function find(int $id): ?UserData
    {
        $user = User::find($id);

        return $user ? UserData::from($user) : null;
    }

    public function search(SearchUser $search): ?UserData
    {
        if (empty(array_filter($search->toArray()))) {
            return null;
        }

        $user = User::when($search->id, fn(Builder $query) => $query->where('id', $search->id))
            ->when($search->email, fn(Builder $query) => $query->where('email', $search->email))
            ->when($search->username, fn(Builder $query) => $query->where('username', $search->username))
            ->first();

        return $user ? UserData::from($user) : null;
    }

    public function create(CreateUser $create): ?UserData
    {
        $user = User::create($create->toArray());

        return $user ? UserData::from($user) : null;
    }
}
