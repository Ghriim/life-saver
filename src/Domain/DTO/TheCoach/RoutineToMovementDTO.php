<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;

class RoutineToMovementDTO extends AbstractBaseDTO
{
    public ?int $targetReps;
    public ?int $targetWeight;
    public ?int $targetDuration;
    public ?int $targetDistance;

    public ?int $targetRest;
    public bool $generateWarmup = false;

    public RoutineDTO $routine;
    public MovementDTO $movement;
}