<?php

namespace App\Infrastructure\View\ViewModel\BodyTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WeightListViewModel implements ViewModelInterface
{
    public int $id;
    public string $weight;
    public string $added;
}
