<?php

namespace App\UseCase\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\Gateway\Persister\BodyTracker\SleepDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveSleepUseCase implements UseCaseInterface
{
    public function __construct(
        private SleepDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(SleepDTO $sleepDTO, int $userId): void
    {
        $sleepDTO->userId = $userId;

        $this->persisterGateway->save($sleepDTO);
    }
}
