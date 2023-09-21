<?php

namespace App\Infrastructure\View\ViewModel\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class MovementInRoutineListViewModel implements ViewModelInterface
{
    public int $id;
    public string $name;
    public string $image;
    public string $added;

    public ?string $targetReps;
    public ?string $targetWeight;
    public ?string $targetDuration;
    public ?string $targetDistance;

    public string $targetRest;
    public string $numberOfSets;
    public ?string $warmupPattern;
}