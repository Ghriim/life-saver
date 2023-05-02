<?php

namespace App\Domain\Gateway\Persister\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\DTO\DTOInterface;

interface SleepDTOPersisterGateway
{
    public function save(DTOInterface|SleepDTO $dto, bool $flush = true): DTOInterface|SleepDTO;

    public function remove(DTOInterface|SleepDTO $dto, bool $flush = true): void;
}