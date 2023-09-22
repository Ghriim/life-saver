<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\ExerciseDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\UseCase\Player\TheCoach\Traits\FetchWorkoutForAlterationTrait;
use App\UseCase\UseCaseInterface;

final class DeleteBatchOfExercisesUseCase implements UseCaseInterface
{
    use FetchWorkoutForAlterationTrait;

    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private ExerciseDTOPersisterGateway $exerciseDTOPersisterGateway,
    ) {

    }

    public function execute(int $workoutId, string $batchId, int $userId): void
    {
        $workout = $this->fetchWorkout($workoutId, $userId);

        foreach ($workout->getExercises() as $exercise) {
            if ($batchId === $exercise->batchId) {
                $this->exerciseDTOPersisterGateway->remove($exercise);
            }
        }
    }
}