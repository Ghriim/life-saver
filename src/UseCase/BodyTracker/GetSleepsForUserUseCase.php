<?php

namespace App\UseCase\BodyTracker;

use App\Domain\Gateway\Provider\BodyTracker\SleepDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\BodyTracker\SleepListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetSleepsForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private SleepDTOProviderGateway $sleepDTOGateway,
        private SleepListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId): array
    {
        $sleepDTOs = $this->sleepDTOGateway->getSleepsByUserId($userId);

        return $this->presenter->present($sleepDTOs);
    }
}
