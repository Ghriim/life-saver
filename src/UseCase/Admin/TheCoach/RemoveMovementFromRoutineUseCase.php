<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\RoutineToMovementDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\RoutineToMovementDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class RemoveMovementFromRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        private RoutineToMovementDTOProviderGateway $providerGateway,
        private RoutineToMovementDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(int $routineToMovementId): void
    {
        $routineToMovement = $this->providerGateway->getRoutineToMovementById($routineToMovementId);
        if (null === $routineToMovement) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($routineToMovement);
    }
}