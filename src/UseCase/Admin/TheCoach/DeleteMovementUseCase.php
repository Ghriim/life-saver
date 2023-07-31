<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\MovementDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private MovementDTOProviderGateway $providerGateway,
        private MovementDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $movementId): void
    {
        $movement = $this->providerGateway->getMovementById($movementId);
        if (null === $movement) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($movement);
    }
}
