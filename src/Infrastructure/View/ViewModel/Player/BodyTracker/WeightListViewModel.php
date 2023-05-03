<?php

namespace App\Infrastructure\View\ViewModel\Player\BodyTracker;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WeightListViewModel implements ViewModelInterface
{
    public int $id;
    public string $weight;
}
