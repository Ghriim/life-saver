<?php

namespace App\Domain\DTO\HydrationTracker;

use App\Domain\DTO\AbstractBaseDTO;

class HydrationSummaryDTO extends AbstractBaseDTO
{
    /**
     * @var int $dailyGoal is in mL
     */
    public int $dailyGoal = 2000;

    /**
     * @var int $dailyProgress is in mL
     */
    public int $dailyProgress = 0;

    public int $userId;
}