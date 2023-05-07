<?php

namespace App\Domain\Gateway\Provider\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;

interface HydrationIntakeDTOProviderGateway
{
    public function getHydrationIntakeById(int $intakeId): ?HydrationIntakeDTO;

    /**
     * @return HydrationIntakeDTO[]
     */
    public function getHydrationIntakesBySummary(HydrationSummaryDTO $summary): array;
}
