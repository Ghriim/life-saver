<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private WorkoutDTOProviderGateway $providerGateway,
        private WorkoutDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(int $workoutId): void
    {
        $workout = $this->providerGateway->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($workout);
    }
}