<?php

namespace App\Infrastructure\Factory\DTOFactory\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\Registry\TheCoach\ExerciseSetTypeRegistry;
use App\Infrastructure\Factory\DTOFactory\DTOFactoryInterface;

final class ExerciseDTOFactory implements DTOFactoryInterface
{
    public function buildExerciseFromMovement(RoutineToMovementDTO $movement, string $batchId): ExerciseDTO
    {
        $exercise = $this->buildCommonFields($movement, $batchId);

        $exercise->targetReps = $movement->targetReps;
        $exercise->targetWeight = $movement->targetWeight;
        $exercise->targetDuration = $movement->targetDuration;
        $exercise->targetDistance = $movement->targetDistance;

        return $exercise;
    }

    public function buildExerciseFromMovementForWarmup(RoutineToMovementDTO $movement, string $batchId, array $setConfig): ExerciseDTO
    {
        $exercise = $this->buildCommonFields($movement, $batchId);

        $exercise->setType = ExerciseSetTypeRegistry::SET_TYPE_WARMUP;

        foreach ($setConfig as $fieldName => $fieldValue) {
            $targetFieldName = 'target'.ucfirst($fieldName);
            $exercise->{$targetFieldName} = $fieldValue;
        }

        return $exercise;
    }

    private function buildCommonFields(RoutineToMovementDTO $movement, string $batchId): ExerciseDTO
    {
        $exercise = new ExerciseDTO();
        $exercise->movement = $movement->movement;

        $exercise->batchId = $batchId;

        $exercise->createDate = new \DateTimeImmutable();
        $exercise->updateDate = new \DateTimeImmutable();

        return $exercise;
    }
}