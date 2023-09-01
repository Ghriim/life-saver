<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;

class ExerciseDTO extends AbstractBaseDTO
{
    public ?int $targetReps;
    public ?int $targetWeight;
    public ?int $targetDuration;
    public ?int $targetDistance;
    
    public ?int $completedReps;
    public ?int $completedWeight;
    public ?int $completedDuration;
    public ?int $completedDistance;

    public ?int $restDuration;

    public MovementDTO $movement;
    public WorkoutDTO $workout;
}