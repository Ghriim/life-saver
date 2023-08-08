<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\Gateway\Persister\TheCoach\RoutineToMovementDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class RoutineToMovementDTOPersister extends AbstractPersister implements RoutineToMovementDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return RoutineToMovementDTO::class;
    }
}