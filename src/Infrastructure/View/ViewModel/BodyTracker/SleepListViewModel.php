<?php

namespace App\Infrastructure\View\ViewModel\BodyTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class SleepListViewModel implements ViewModelInterface
{
    public ?int $id = null;
    public ?string $inBed = null;
    public ?string $outOfBed = null;
    public ?string $duration = null;
}
