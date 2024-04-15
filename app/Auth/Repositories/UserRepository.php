<?php

declare(strict_types=1);

namespace App\Auth\Repositories;

use App\Auth\Models\User;
use App\Auth\Repositories\Data\CreateUser;
use App\Auth\Repositories\Data\SearchUser;
use App\Auth\Services\Data\UserData;
use Illuminate\Database\Eloquent\Builder;

final class UserRepository
{
    public function find(int $id): ?UserData
    {
        $user = User::find($id);

        return $user ? UserData::from($user) : null;
    }

    public function search(SearchUser $request): ?UserData
    {
        if (empty(array_filter($request->toArray()))) {
            return null;
        }

        $user = User::when($request->id, fn(Builder $query) => $query->where('id', $request->id))
            ->when($request->email, fn(Builder $query) => $query->where('email', $request->email))
            ->when($request->username, fn(Builder $query) => $query->where('username', $request->username))
            ->first();

        return $user ? UserData::from($user) : null;
    }

    public function create(CreateUser $request): ?UserData
    {
        $user = User::create($request->toArray());

        return $user ? UserData::from($user) : null;
    }
}
