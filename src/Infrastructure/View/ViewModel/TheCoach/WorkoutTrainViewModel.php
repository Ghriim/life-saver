<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class WorkoutTrainViewModel implements ViewModelInterface
{
    public WorkoutDetailsViewModel $workout;

    public ?string $currentBatchId;
    public ?int $currentExerciseId;
}