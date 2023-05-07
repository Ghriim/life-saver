<?php

namespace App\Domain\DTO\HydrationTracker;

use App\Domain\DTO\AbstractBaseDTO;

class HydrationIntakeDTO extends AbstractBaseDTO
{
    /**
     * @var int $volume is in mL
     */
    public int $volume;

    public HydrationSummaryDTO $summary;
}