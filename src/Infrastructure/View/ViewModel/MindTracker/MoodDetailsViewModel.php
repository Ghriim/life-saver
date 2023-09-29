<?php

namespace App\Infrastructure\View\ViewModel\MindTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class MoodDetailsViewModel implements ViewModelInterface
{
    public int $id;
    public int $level;
    public ?string $description;
}