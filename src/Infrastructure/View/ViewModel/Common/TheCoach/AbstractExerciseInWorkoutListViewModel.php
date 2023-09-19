<?php

namespace App\Infrastructure\View\ViewModel\Common\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewModel\ViewModelInterface;

abstract class AbstractExerciseInWorkoutListViewModel implements ViewModelInterface
{
    public int $id;

    public ?string $targetReps;
    public ?string $targetWeight;
    public ?string $targetDuration;
    public ?string $targetDistance;

    public ?string $completedReps;
    public ?string $completedWeight;
    public ?string $completedDuration;
    public ?string $completedDistance;

    public ?int $restDuration;

    public string $movementId;
    public string $movementName;
}
