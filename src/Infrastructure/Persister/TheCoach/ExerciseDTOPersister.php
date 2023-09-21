<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\Gateway\Persister\TheCoach\ExerciseDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class ExerciseDTOPersister extends AbstractPersister implements ExerciseDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return ExerciseDTO::class;
    }
}