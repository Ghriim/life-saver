<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\Gateway\Persister\TheCoach\RoutineDTOPersisterGateway;
use App\Domain\Gateway\Persister\TheCoach\RoutineToMovementDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AddMovementToRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        private RoutineDTOProviderGateway $providerGateway,
        private RoutineToMovementDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(int $routineId, RoutineToMovementDTO $routineToMovementDTO): void
    {
        $routine = $this->providerGateway->getRoutineById($routineId);
        if (null === $routine) {
            throw new NotFoundHttpException();
        }

        $routineToMovementDTO->routine = $routine;

        $this->persisterGateway->save($routineToMovementDTO);
    }
}