<?php

namespace App\Infrastructure\View\ViewModel\Admin\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class RoutineListViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $added;
}