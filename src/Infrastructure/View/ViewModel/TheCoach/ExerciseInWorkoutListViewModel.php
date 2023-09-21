<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class ExerciseInWorkoutListViewModel implements ViewModelInterface
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

    public ?string $restDuration;

    public string $setType;

    public string $movementId;
    public string $movementName;

    public string $batchId;
}
