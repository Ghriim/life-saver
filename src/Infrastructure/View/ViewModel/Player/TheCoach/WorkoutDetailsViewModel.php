<?php

namespace App\Infrastructure\View\ViewModel\Player\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WorkoutDetailsViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;

    public ?string $plannedDate;
    public ?string $startedDate;
    public ?string $completedDate;

    public ?int $routineId = null;
    public ?string $routineTitle = null;

    public array $exercises;
}