<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\ExerciseDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteBatchOfExercisesUseCase implements UseCaseInterface
{
    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private ExerciseDTOPersisterGateway $exerciseDTOPersisterGateway,
    ) {

    }

    public function execute(int $workoutId, string $batchId, int $userId): void
    {
        $workout = $this->workoutDTOProviderGateway->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        if ($workoutId !== $workout->id || $userId !== $workout->userId) {
            throw new AccessDeniedHttpException();
        }

        foreach ($workout->getExercises() as $exercise) {
            if ($batchId === $exercise->batchId) {
                $this->exerciseDTOPersisterGateway->remove($exercise);
            }
        }
    }
}