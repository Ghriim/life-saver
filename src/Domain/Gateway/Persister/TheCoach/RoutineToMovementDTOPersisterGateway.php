<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;

interface RoutineToMovementDTOPersisterGateway
{
    public function save(DTOInterface|RoutineToMovementDTO $dto, bool $flush = true): null|DTOInterface|RoutineToMovementDTO;

    public function remove(DTOInterface|RoutineToMovementDTO $dto, bool $flush = true): void;
}