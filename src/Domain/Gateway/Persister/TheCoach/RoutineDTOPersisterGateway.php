<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\RoutineDTO;

interface RoutineDTOPersisterGateway
{
    public function save(DTOInterface|RoutineDTO $dto, bool $flush = true): null|DTOInterface|RoutineDTO;

    public function remove(DTOInterface|RoutineDTO $dto, bool $flush = true): void;
}