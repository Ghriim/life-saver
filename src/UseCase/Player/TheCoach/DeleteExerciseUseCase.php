<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\ExerciseDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\ExerciseDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteExerciseUseCase implements UseCaseInterface
{
    public function __construct(
        private ExerciseDTOProviderGateway $exerciseDTOProviderGateway,
        private ExerciseDTOPersisterGateway $exerciseDTOPersisterGateway,
    ) {
    }

    public function execute(int $workoutId, int $exerciseId, int $userId): void
    {
        $exercise = $this->exerciseDTOProviderGateway->getExerciseById($exerciseId);
        if (null === $exercise) {
            throw new NotFoundHttpException();
        }

        $workout = $exercise->workout;
        if ($workoutId !== $workout->id || $userId !== $workout->userId) {
            throw new AccessDeniedHttpException();
        }

        $this->exerciseDTOPersisterGateway->remove($exercise);
    }
}