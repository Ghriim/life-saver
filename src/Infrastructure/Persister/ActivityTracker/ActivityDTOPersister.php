<?php

namespace App\Infrastructure\Persister\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Domain\Gateway\Persister\ActivityTracker\ActivityDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class ActivityDTOPersister extends AbstractPersister implements ActivityDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return ActivityDTO::class;
    }
}
