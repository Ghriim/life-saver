<?php

namespace App\UseCase\Player\HydrationTracker;

use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\HydrationTracker\HydrationSummaryListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetHydrationSummariesForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private HydrationSummaryDTOProviderGateway $summaryDTOGateway,
        private HydrationSummaryListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId): array
    {
        $summaryDTOs = $this->summaryDTOGateway->getHydrationSummariesByUserId($userId);

        return $this->presenter->present($summaryDTOs);
    }
}
