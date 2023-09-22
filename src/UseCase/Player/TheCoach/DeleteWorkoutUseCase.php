<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
    ) {

    }

    public function execute(int $workoutId, int $userId): void
    {
        $workout = $this->workoutDTOProviderGateway->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        if ($userId !== $workout->userId) {
            throw new AccessDeniedHttpException();
        }

        $this->workoutDTOPersisterGateway->remove($workout);
    }
}