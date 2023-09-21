<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class ExerciseBatchInWorkoutDetailsViewModel implements ViewModelInterface
{
    public string $batchId;

    public int $movementId;
    public string $movementName;

    /** @var ExerciseInWorkoutListViewModel[] */
    public array $exercises;
}