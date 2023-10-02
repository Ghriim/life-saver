<?php

namespace App\Infrastructure\Persister\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

class UserDTOPersister extends AbstractPersister implements UserDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}