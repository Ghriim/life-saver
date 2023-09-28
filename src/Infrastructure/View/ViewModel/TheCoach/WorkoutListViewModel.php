<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WorkoutListViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $status;
    public ?string $plannedDate;
    public ?string $completedDate;
}

