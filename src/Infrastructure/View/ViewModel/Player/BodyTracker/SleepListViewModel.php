<?php

namespace App\Infrastructure\View\ViewModel\Player\BodyTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class SleepListViewModel implements ViewModelInterface
{
    public int $id;
    public string $inBed;
    public ?string $outOfBed;
    public ?string $duration;
}
