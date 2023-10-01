<?php

namespace App\UseCase\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationIntakeDTOProviderGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\Infrastructure\View\ViewModel\HydrationTracker\HydrationSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\HydrationTracker\HydrationSummaryDetailsViewPresenter;
use App\UseCase\Player\HydrationTracker\Traits\ProvideHydrationSummaryTrait;
use App\UseCase\UseCaseInterface;

final class GetHydrationSummaryForDateUseCase implements UseCaseInterface
{
    use ProvideHydrationSummaryTrait;

    public function __construct(
        private HydrationSummaryDTOProviderGateway $summaryProviderGateway,
        private HydrationSummaryDTOPersisterGateway $summaryPersister,
        private HydrationSummaryDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, \DateTimeImmutable $date): HydrationSummaryDetailsViewModel
    {
        $summary = $this->provideSummary($userId, $date);
        if (null === $summary) {
            $summary = new HydrationSummaryDTO();
            $summary->userId = $userId;

            $this->summaryPersister->save($summary);
        }

        return  $this->presenter->present($summary, null);
    }
}