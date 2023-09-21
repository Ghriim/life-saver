<?php

namespace App\Infrastructure\View\ViewModel\HydrationTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class HydrationSummaryDetailsViewModel implements ViewModelInterface
{
    public string $added;
    public int $dailyGoal;
    public int $dailyProgress;
    public string $completion;

    /**
     * @var HydrationIntakeInSummaryDetailsViewModel[]
     */
    public array $intakes;
}