<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class WorkoutDTOPersister extends AbstractPersister implements WorkoutDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return WorkoutDTO::class;
    }
}