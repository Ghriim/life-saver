<?php

namespace App\Domain\Gateway\Persister\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\DTO\DTOInterface;

interface HydrationSummaryDTOPersisterGateway
{
    public function save(DTOInterface|HydrationSummaryDTO $dto, bool $flush = true): null|DTOInterface|HydrationSummaryDTO;

    public function remove(DTOInterface|HydrationSummaryDTO $dto, bool $flush = true): void;
}