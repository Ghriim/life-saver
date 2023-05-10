<?php

namespace App\Domain\Gateway\Persister\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Domain\DTO\DTOInterface;

interface ActivityDTOPersisterGateway
{
    public function save(DTOInterface|ActivityDTO $dto, bool $flush = true): DTOInterface|ActivityDTO;

    public function remove(DTOInterface|ActivityDTO $dto, bool $flush = true): void;
}