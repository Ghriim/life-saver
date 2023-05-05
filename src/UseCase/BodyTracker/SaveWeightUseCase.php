<?php

namespace App\UseCase\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Domain\Gateway\Persister\BodyTracker\WeightDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveWeightUseCase implements UseCaseInterface
{
    public function __construct(
        private WeightDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(WeightDTO $weightDTO, int $userId): void
    {
        $weightDTO->userId = $userId;

        $this->persisterGateway->save($weightDTO);
    }
}
