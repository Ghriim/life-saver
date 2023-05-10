<?php

namespace App\UseCase\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationIntakeDTOProviderGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\Infrastructure\View\ViewModel\Player\HydrationTracker\HydrationSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\Player\HydrationTracker\HydrationSummaryDetailsViewPresenter;
use App\UseCase\HydrationTracker\Traits\ProvideHydrationSummaryTrait;
use App\UseCase\UseCaseInterface;

final class GetHydrationSummaryForDateUseCase implements UseCaseInterface
{
    use ProvideHydrationSummaryTrait;

    public function __construct(
        private HydrationSummaryDTOProviderGateway $summaryProviderGateway,
        private HydrationSummaryDTOPersisterGateway $summaryPersister,
        private HydrationIntakeDTOProviderGateway $intakeProviderGateway,
        private HydrationSummaryDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, string $dateAsString): HydrationSummaryDetailsViewModel
    {
        $summary = $this->provideSummary($userId, $dateAsString);
        if (null === $summary) {
            $summary = new HydrationSummaryDTO();
            $summary->userId = $userId;

            $this->summaryPersister->save($summary);
        }

        $intakes = $this->intakeProviderGateway->getHydrationIntakesBySummary($summary);

        return  $this->presenter->present($summary, $intakes);
    }
}