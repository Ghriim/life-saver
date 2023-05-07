<?php

namespace App\UseCase\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationIntakeDTOProviderGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\Infrastructure\View\ViewModel\Player\HydrationTracker\HydrationSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\Player\HydrationTracker\HydrationSummaryDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use DateTimeImmutable;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetHydrationSummaryForDateUseCase implements UseCaseInterface
{
    public function __construct(
        private HydrationSummaryDTOProviderGateway $summaryProviderGateway,
        private HydrationIntakeDTOProviderGateway $intakeProviderGateway,
        private HydrationSummaryDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, string $dateAsString): HydrationSummaryDetailsViewModel
    {
        try {
            $date = new DateTimeImmutable($dateAsString);
        } catch (Exception) {
            throw new NotFoundHttpException();
        }

        if ($date > new DateTimeImmutable()) {
            throw new NotFoundHttpException();
        }

        $summary = $this->summaryProviderGateway->getHydrationSummaryByUserIdAndDate($userId, $date);
        if (null === $summary) {
            $summary = new HydrationSummaryDTO();
            $summary->userId = $userId;
        }

        $intakes = $this->intakeProviderGateway->getHydrationIntakesBySummary($summary);

        return  $this->presenter->present($summary, $intakes);
    }
}