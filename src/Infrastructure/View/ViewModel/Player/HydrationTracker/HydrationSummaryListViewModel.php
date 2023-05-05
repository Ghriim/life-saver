<?php

namespace App\Infrastructure\View\ViewModel\Player\HydrationTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class HydrationSummaryListViewModel implements ViewModelInterface
{
    public string $added;
    public string $completion;
}