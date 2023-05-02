<?php

namespace App\UseCase\BodyTracker;

use App\Domain\Gateway\BodyTracker\GetSleepDTOGateway;
use App\Infrastructure\View\ViewPresenter\Player\BodyTracker\SleepListViewPresenter;

final class GetSleepsForUserUseCase
{
    public function __construct(
        private GetSleepDTOGateway $sleepDTOGateway,
        private SleepListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId): array
    {
        $sleepDTOs = $this->sleepDTOGateway->getSleepsByUserId($userId);

        return $this->presenter->present($sleepDTOs);
    }
}
