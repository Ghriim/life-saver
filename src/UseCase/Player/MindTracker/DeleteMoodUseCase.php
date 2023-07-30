<?php

namespace App\UseCase\Player\MindTracker;

use App\Domain\Gateway\Persister\MindTracker\MoodDTOPersisterGateway;
use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteMoodUseCase implements UseCaseInterface
{
    public function __construct(
        private MoodDTOProviderGateway $providerGateway,
        private MoodDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $moodId): void
    {
        $mood = $this->providerGateway->getMoodById($moodId);
        if (null === $mood) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($mood);
    }
}
