<?php

namespace App\Infrastructure\Persister\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationIntakeDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class HydrationIntakeDTOPersister extends AbstractPersister implements HydrationIntakeDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return HydrationIntakeDTO::class;
    }
}