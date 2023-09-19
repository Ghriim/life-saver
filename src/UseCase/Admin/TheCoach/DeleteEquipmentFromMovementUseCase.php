<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\MovementDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteEquipmentFromMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private MovementDTOProviderGateway $providerGateway,
        private MovementDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(int $movementId, int $equipmentId): void
    {
        $movement = $this->providerGateway->getMovementById($movementId);
        if (null === $movement) {
            throw new NotFoundHttpException();
        }

        $movement->removeEquipment($equipmentId);

        $this->persisterGateway->save($movement);
    }
}