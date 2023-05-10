<?php

namespace App\UseCase\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Domain\Gateway\Persister\ActivityTracker\ActivityDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveActivityUseCase implements UseCaseInterface
{
    public function __construct(
        private ActivityDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(ActivityDTO $activity, int $userId): void
    {
        $activity->userId = $userId;

        $this->persisterGateway->save($activity);
    }
}