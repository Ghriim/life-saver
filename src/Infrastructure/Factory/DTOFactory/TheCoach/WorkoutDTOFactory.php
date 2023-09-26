<?php

namespace App\Infrastructure\Factory\DTOFactory\TheCoach;

use App\Domain\DataTransformer\TheCoach\WarmupPatternDataTransformer;
use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\Factory\DTOFactory\DTOFactoryInterface;

final class WorkoutDTOFactory implements DTOFactoryInterface
{
    public function __construct(
        private ExerciseDTOFactory $exerciseDTOFactory,
    ) {

    }
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

            $this->buildWarmUpSets($workout, $movement, $batchId);

            for ($i = 1; $i <= $movement->numberOfSets; $i++) {
                $exercise = $this->exerciseDTOFactory->buildExerciseFromMovement(
                    $movement,
                    $batchId
                );
                $exercise->workout = $workout;

                $workout->addExercise($exercise);
            }

        }
    }

    private function buildWarmUpSets(WorkoutDTO $workout, RoutineToMovementDTO $movement, string $batchId): void
    {
        $pattern = $movement->warmupPattern?->pattern;
        if (null === $pattern) {
            return;
        }

        $warmupConfigs = explode('||', $pattern);
        foreach ($warmupConfigs as $warmupConfig) {
            $setConfigs = WarmupPatternDataTransformer::patternToWeights($warmupConfig, $movement->targetWeight);
            foreach ($setConfigs as $setConfig) {
                $exercise = $this->exerciseDTOFactory->buildExerciseFromMovementForWarmup(
                    $movement,
                    $batchId,
                    $setConfig
                );

                $exercise->workout = $workout;
                $workout->addExercise($exercise);
            }
        }
    }
}