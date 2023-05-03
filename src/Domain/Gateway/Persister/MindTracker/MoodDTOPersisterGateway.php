<?php

namespace App\Domain\Gateway\Persister\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\DTO\DTOInterface;

interface MoodDTOPersisterGateway
{
    public function save(DTOInterface|MoodDTO $dto, bool $flush = true): DTOInterface|MoodDTO;

    public function remove(DTOInterface|MoodDTO $dto, bool $flush = true): void;
}