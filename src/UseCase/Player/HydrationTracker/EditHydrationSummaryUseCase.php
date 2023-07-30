<?php

namespace App\UseCase\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\UseCase\UseCaseInterface;

final class EditHydrationSummaryUseCase implements UseCaseInterface
{
    public function __construct(
        private HydrationSummaryDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(HydrationSummaryDTO $summaryDTO): void
    {
        $this->persisterGateway->save($summaryDTO);
    }
}