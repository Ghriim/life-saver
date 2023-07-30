<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Domain\Gateway\Persister\TheCoach\EquipmentDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveEquipmentUseCase implements UseCaseInterface
{
    public function __construct(
        public EquipmentDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(EquipmentDTO $equipmentDTO, int $adminId)
    {
        $this->persisterGateway->save($equipmentDTO);
    }
}

