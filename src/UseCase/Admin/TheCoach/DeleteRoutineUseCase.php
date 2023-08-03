<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\RoutineDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        private RoutineDTOProviderGateway $providerGateway,
        private RoutineDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $routineId): void
    {
        $routine = $this->providerGateway->getRoutineById($routineId);
        if (null === $routine) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($routine);
    }
}
