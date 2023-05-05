<?php

namespace App\Domain\Gateway\Provider\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use DateTimeImmutable;

interface HydrationSummaryDTOProviderGateway
{
    public function getHydrationSummaryById(int $summaryId): ?HydrationSummaryDTO;

    public function getHydrationSummaryByUserIdAndDate(int $userId, DateTimeImmutable $date): ?HydrationSummaryDTO;

    /**
     * @return HydrationSummaryDTO[]
     */
    public function getHydrationSummariesByUserId(int $userId): array;
}
