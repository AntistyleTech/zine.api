<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use App\Exceptions\LogicException;
use Modules\User\Enum\ContactType;
use Modules\User\Services\Data\ContactData;
use Throwable;

final class ContactAlreadyInUse extends LogicException
{
    public function __construct(ContactData $contact)
    {
        $contactString = "{$contact->type->value}:{$contact->value}";
        parent::__construct("Contact {$contactString} already in use");
    }
}
