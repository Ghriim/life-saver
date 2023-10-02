<?php

namespace App\Infrastructure\Persister\User;

use App\Domain\DTO\User\UserSummaryDTO;
use App\Domain\Gateway\Persister\User\UserSummaryDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

class UserSummaryDTOPersister extends AbstractPersister implements UserSummaryDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return UserSummaryDTO::class;
    }
}