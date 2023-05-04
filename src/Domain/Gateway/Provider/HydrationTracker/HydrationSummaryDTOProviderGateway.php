<?php

namespace App\Domain\Gateway\Provider\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;

interface HydrationSummaryDTOProviderGateway
{
    public function getHydrationSummaryById(int $summaryId): ?HydrationSummaryDTO;

    /**
     * @return HydrationSummaryDTO[]
     */
    public function getHydrationSummariesByUserId(int $userId): array;
}
