<?php

namespace App\UseCase\MindTracker;

use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\MindTracker\MoodListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetMoodsForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private MoodDTOProviderGateway $sleepDTOGateway,
        private MoodListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId): array
    {
        $sleepDTOs = $this->sleepDTOGateway->getMoodsByUserId($userId);

        return $this->presenter->present($sleepDTOs);
    }
}
