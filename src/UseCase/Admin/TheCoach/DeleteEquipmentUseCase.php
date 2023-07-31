<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\EquipmentDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\EquipmentDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteEquipmentUseCase implements UseCaseInterface
{
    public function __construct(
        private EquipmentDTOProviderGateway $providerGateway,
        private EquipmentDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $equipmentId): void
    {
        $equipment = $this->providerGateway->getEquipmentById($equipmentId);
        if (null === $equipment) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($equipment);
    }
}
