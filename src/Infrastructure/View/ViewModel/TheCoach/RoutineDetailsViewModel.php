<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class RoutineDetailsViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $added;

    /** @var MovementInRoutineListViewModel[] */
    public array $movements;
}