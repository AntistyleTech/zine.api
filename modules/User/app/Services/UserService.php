<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\User\Exceptions\ContactAlreadyInUse;
use Modules\User\Exceptions\UsernameAlreadyInUse;
use Modules\User\Exceptions\UserSavingException;
use Modules\User\Models\Account;
use Modules\User\Models\User;
use Modules\User\Services\Commands\CreateUser;
use Modules\User\Services\Commands\SearchUser;

final readonly class UserService
{
    /**
     * @throws ContactAlreadyInUse|UsernameAlreadyInUse|UserSavingException|\Throwable
     */
    public function create(CreateUser $createUser): User
    {
        return DB::transaction(function () use ($createUser): User {
            $name = $createUser->name;
            if (User::where('name', $name)->exists()) {
                throw new UsernameAlreadyInUse($name);
            }

            if (Account::where('name', $name)->exists()) {
                throw new UsernameAlreadyInUse($name);
            }

            $contact = $createUser->contact;
            $user = $this->search(new SearchUser(contact: $contact));
            if ($user !== null) {
                throw new ContactAlreadyInUse($contact);
            }

            $password = $createUser->password;

            $user = User::create(['name' => $name, 'password' => $password]);

            $user->accounts()->create(['name' => $name]);
            $user->contacts()->create(['type' => $contact->type, 'value' => $contact->value]);

            $user->save() ?: throw new UserSavingException('User not saved');

            return $user;
        });
    }

    public function search(SearchUser $search): ?User
    {
        if (empty(array_filter($search->toArray()))) {
            return null;
        }

        $user = User::when(
            $search->id,
            fn ($query) => $query->where('id', $search->id)
        )->when(
            $search->contact,
            fn ($query) => $query->whereHas(
                'contacts',
                fn ($q) => $q->where('type', $search->contact->type->value)
                    ->where('value', $search->contact->value)
            )
        )->when(
            $search->name,
            fn ($query) => $query->where('name', $search->name)
        )->first();

        return $user;
    }
}
