<?php

namespace App\UseCase\Player\MindTracker;

use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\Infrastructure\View\ViewModel\MindTracker\MoodDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\MindTracker\MoodDetailsViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetLastMoodOfDateForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private MoodDTOProviderGateway $moodDTOProviderGateway,
        private MoodDetailsViewPresenter $moodDetailsViewPresenter,
    ) {

    }

    public function execute(int $userId, \DateTimeImmutable $date): ?MoodDetailsViewModel
    {
        $mood = $this->moodDTOProviderGateway->getLastMoodOfDateByUserId($userId, $date);
        if (null === $mood) {
            return null;
        }

        return $this->moodDetailsViewPresenter->present($mood);
    }
}