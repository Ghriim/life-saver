<?php

namespace App\Infrastructure\View\ViewModel\Common\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

abstract class AbstractMovementInRoutineListViewModel implements ViewModelInterface
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
    public string $generateWarmup;
}