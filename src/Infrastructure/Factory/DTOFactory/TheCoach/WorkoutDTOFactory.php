<?php

namespace App\Infrastructure\Factory\DTOFactory\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\Factory\DTOFactory\DTOFactoryInterface;

final class WorkoutDTOFactory implements DTOFactoryInterface
{
    public function buildFromRoutine(RoutineDTO $routine): WorkoutDTO
    {
        $workout = new WorkoutDTO();

        $workout->title = $routine->title;
        $workout->routine = $routine;

        $this->buildExercisesFromMovements($workout, $routine->getMovements());

        return $workout;
    }

    /**
     * @param RoutineToMovementDTO[] $movements
     */
    private function buildExercisesFromMovements(WorkoutDTO $workout, array $movements): void
    {
        foreach ($movements as $movement) {
            $exercise = new ExerciseDTO();
            $exercise->workout = $workout;
            $exercise->movement = $movement->movement;

            $exercise->targetReps = $movement->targetReps;
            $exercise->targetWeight = $movement->targetWeight;
            $exercise->targetDuration = $movement->targetDuration;
            $exercise->targetDistance = $movement->targetDistance;

            $exercise->createDate = new \DateTimeImmutable();
            $exercise->updateDate = new \DateTimeImmutable();

            $workout->addExercise($exercise);
        }
    }
}