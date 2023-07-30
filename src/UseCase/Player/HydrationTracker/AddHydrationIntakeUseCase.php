<?php

namespace App\UseCase\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationIntakeDTOPersisterGateway;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\UseCase\Player\HydrationTracker\Traits\ProvideHydrationSummaryTrait;
use App\UseCase\UseCaseInterface;

final class AddHydrationIntakeUseCase implements UseCaseInterface
{
    use ProvideHydrationSummaryTrait;

    public function __construct(
        private HydrationSummaryDTOProviderGateway $summaryProviderGateway,
        private HydrationSummaryDTOPersisterGateway $summaryPersisterGateway,
        private HydrationIntakeDTOPersisterGateway $intakePersisterGateway,
    ) {

    }

    public function execute(HydrationIntakeDTO $intake, string $dateAsString, int $userId): void
    {
        $summary = $this->provideSummary($userId, $dateAsString);
        if (null === $summary) {
            $summary = new HydrationSummaryDTO();
            $summary->userId = $userId;
            $summary->dailyProgress = $intake->volume;
        } else {
            $summary->dailyProgress += $intake->volume;
        }

        $intake->summary = $summary;


        $this->summaryPersisterGateway->save($summary, false);
        $this->intakePersisterGateway->save($intake);
    }
}
