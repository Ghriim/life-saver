<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\MovementDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AddEquipmentInMovementUseCase implements UseCaseInterface
{
    public function __construct(
        private MovementDTOProviderGateway $providerGateway,
        private MovementDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(int $movementId, array $data): void
    {
        $movement = $this->providerGateway->getMovementById($movementId);
        if (null === $movement) {
            throw new NotFoundHttpException();
        }

        $movement->addEquipment($data['equipment']);

        $this->persisterGateway->save($movement);
    }
}