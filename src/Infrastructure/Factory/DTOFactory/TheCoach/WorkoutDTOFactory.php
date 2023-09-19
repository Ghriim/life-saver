<?php

namespace App\Infrastructure\Factory\DTOFactory\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\Factory\DTOFactory\DTOFactoryInterface;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

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
            $batchId = uniqid();
            for ($i = 1; $i <= $movement->numberOfSets; $i++) {
                $exercise = $this->buildExerciseFromMovement($movement, $batchId);
                $exercise->workout = $workout;

                $workout->addExercise($exercise);
            }

        }
    }

    private function buildExerciseFromMovement(RoutineToMovementDTO $movement, string $batchId): ExerciseDTO
    {
        $exercise = new ExerciseDTO();
        $exercise->movement = $movement->movement;

        $exercise->targetReps = $movement->targetReps;
        $exercise->targetWeight = $movement->targetWeight;
        $exercise->targetDuration = $movement->targetDuration;
        $exercise->targetDistance = $movement->targetDistance;

        $exercise->batchId = $batchId;

        $exercise->createDate = new \DateTimeImmutable();
        $exercise->updateDate = new \DateTimeImmutable();

        return $exercise;
    }
}