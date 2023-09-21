<?php

namespace App\UseCase\Player\MindTracker;

use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\MindTracker\MoodListViewPresenter;
use App\UseCase\UseCaseInterface;
use DateTimeImmutable;

final class GetMoodsForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private MoodDTOProviderGateway $moodDTOGateway,
        private MoodListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, ?string $date): array
    {
        if (null === $date) {
            $moods = $this->moodDTOGateway->getMoodsByUserId($userId);
        } else {
            $moods = $this->moodDTOGateway->getMoodsByUserIdAndDate($userId, new DateTimeImmutable($date));
        }

        return $this->presenter->present($moods);
    }
}
