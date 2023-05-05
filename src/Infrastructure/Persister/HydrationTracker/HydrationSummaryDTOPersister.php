<?php

namespace App\Infrastructure\Persister\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class HydrationSummaryDTOPersister extends AbstractPersister implements HydrationSummaryDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return HydrationSummaryDTO::class;
    }
}
