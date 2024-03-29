<?php

namespace App\Infrastructure\View\ViewModel\ActivityTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class ActivityListViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $added;
}