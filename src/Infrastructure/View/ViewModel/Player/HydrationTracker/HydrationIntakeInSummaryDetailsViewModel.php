<?php

namespace App\Infrastructure\View\ViewModel\Player\HydrationTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class HydrationIntakeInSummaryDetailsViewModel implements ViewModelInterface
{
    public int $id;

    public string $volume;
}