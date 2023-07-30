<?php

namespace App\UseCase\Player\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\Gateway\Persister\MindTracker\MoodDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class SaveMoodUseCase implements UseCaseInterface
{
    public function __construct(
        private MoodDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(MoodDTO $moodDTO, int $userId): void
    {
        $moodDTO->userId = $userId;

        $this->persisterGateway->save($moodDTO);
    }
}
