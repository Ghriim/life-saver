<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\Gateway\Persister\TheCoach\RoutineDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class RoutineDTOPersister extends AbstractPersister implements RoutineDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return RoutineDTO::class;
    }
}