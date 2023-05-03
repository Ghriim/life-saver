<?php

namespace App\Infrastructure\View\ViewModel\Player\MindTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class MoodListViewModel implements ViewModelInterface
{
    public int $id;
    public int $level;
    public ?string $description;
    public string $added;
}