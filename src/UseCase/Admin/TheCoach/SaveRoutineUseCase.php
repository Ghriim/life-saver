<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\Gateway\Persister\TheCoach\RoutineDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        public RoutineDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(RoutineDTO $routineDTO, int $adminId): RoutineDTO
    {
        $this->persisterGateway->save($routineDTO);

        return $routineDTO;
    }
}

