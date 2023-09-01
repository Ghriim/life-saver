<?php

namespace App\Infrastructure\Factory\DTOFactory\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\Factory\DTOFactory\DTOFactoryInterface;

final class WorkoutDTOFactory implements DTOFactoryInterface
{
    public function buildFromRoutine(RoutineDTO $routine): WorkoutDTO
    {
        $workout = new WorkoutDTO();

        $workout->title = $routine->title;

        $workout->routine = $routine;

        return $workout;
    }
}