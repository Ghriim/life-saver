<?php

namespace App\Domain\Gateway\Persister\HydrationTracker;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;

interface HydrationIntakeDTOPersisterGateway
{
    public function save(DTOInterface|HydrationIntakeDTO $dto, bool $flush = true): DTOInterface|HydrationIntakeDTO;

    public function remove(DTOInterface|HydrationIntakeDTO $dto, bool $flush = true): void;
}