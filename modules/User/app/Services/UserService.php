<?php

declare(strict_types=1);

namespace Modules\User\Services;

use Modules\User\Exceptions\ContactAlreadyInUse;
use Modules\User\Exceptions\UsernameAlreadyInUse;
use Modules\User\Exceptions\UserSavingException;
use Modules\User\Models\Account;
use Modules\User\Models\Contact;
use Modules\User\Models\User;
use Modules\User\Services\Commands\CreateUser;
use Modules\User\Services\Commands\SearchUser;
use Modules\User\Services\Data\ContactData;

final readonly class UserService
{
    /**
     * @throws ContactAlreadyInUse|UsernameAlreadyInUse|UserSavingException
     */
    public function create(CreateUser $createUser): User
    {
        $name = $createUser->name;
        $user = User::where('name', $name)->first();
        if ($user !== null) {
            throw new UsernameAlreadyInUse($name);
        }

        $account = Account::where('name', $name)->first();
        if ($account !== null) {
            throw new UsernameAlreadyInUse($name);
        }

        $contact = $createUser->contact;
        $user = $this->search(new SearchUser(contact: $contact));
        if ($user !== null) {
            throw new ContactAlreadyInUse($contact);
        }

        $password = $createUser->password;

        $user = new User(['name' => $name, 'password' => $password]);
        $user->accounts()->create(['name' => $name]);
        $user->contacts()->create(['type' => $contact->type, 'value' => $contact->value]);

        $user->save() ?: throw new UserSavingException('User not saved');

        return $user;
    }

    public function search(SearchUser $search): ?User
    {
        if (empty(array_filter($search->toArray()))) {
            return null;
        }

        $user = User::when(
            $search->id,
            fn($query) => $query->where('id', $search->id)
        )->when(
            $search->contact,
            fn($query) => $query->whereHas(
                'contacts',
                fn($q) => $q->where('type', $search->contact->type->value)
                    ->where('value', $search->contact->value)
            )
        )->when(
            $search->name,
            fn($query) => $query->where('name', $search->name)
        )->first();

        return $user;
    }
}
