<?php

namespace App\Infrastructure\View\ViewModel\Player\HydrationTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class HydrationSummaryDetailsViewModel implements ViewModelInterface
{
    public string $added;
    public int $dailyGoal;
    public int $dailyProgress;
    public string $completion;
}