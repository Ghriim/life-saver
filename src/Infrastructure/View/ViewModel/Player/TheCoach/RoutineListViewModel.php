<?php

namespace App\Infrastructure\View\ViewModel\Player\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class RoutineListViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
}