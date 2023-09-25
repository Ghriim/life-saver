<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\TheCoach\ExerciseBatchInWorkoutDetailsViewModel;
use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WorkoutDetailsViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $status;

    public ?string $plannedDate;
    public ?string $startedDate;
    public ?string $completedDate;

    public ?int $routineId = null;
    public ?string $routineTitle = null;

    /** @var ExerciseBatchInWorkoutDetailsViewModel[] */
    public array $batches;
}