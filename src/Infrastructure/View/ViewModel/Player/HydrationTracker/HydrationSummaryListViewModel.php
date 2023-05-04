<?php

namespace App\Infrastructure\View\ViewModel\Player\HydrationTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class HydrationSummaryListViewModel implements ViewModelInterface
{
    public int $id;
    public int $dailyGoal;
    public int $dailyProgress;
    public float $completion;
    public string $added;
}