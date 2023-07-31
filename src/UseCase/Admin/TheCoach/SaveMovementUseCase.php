<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\Gateway\Persister\TheCoach\MovementDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveMovementUseCase implements UseCaseInterface
{
    public function __construct(
        public MovementDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(MovementDTO $movementDTO, int $adminId)
    {
        $this->persisterGateway->save($movementDTO);
    }
}

