<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;
use App\Domain\Registry\TheCoach\ExerciseSetTypeRegistry;

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

    public string $batchId;
    public string $setType = ExerciseSetTypeRegistry::SET_TYPE_WORK;

    public MovementDTO $movement;
    public WorkoutDTO $workout;
}