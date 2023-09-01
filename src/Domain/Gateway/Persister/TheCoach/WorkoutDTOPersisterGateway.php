<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\WorkoutDTO;

interface WorkoutDTOPersisterGateway
{
    public function save(DTOInterface|WorkoutDTO $dto, bool $flush = true): null|DTOInterface|WorkoutDTO;

    public function remove(DTOInterface|WorkoutDTO $dto, bool $flush = true): void;
}