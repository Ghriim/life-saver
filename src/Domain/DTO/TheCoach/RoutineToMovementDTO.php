<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;

class RoutineToMovementDTO extends AbstractBaseDTO
{
    public const DEFAULT_NUMBER_OF_SETS = 1;

    public ?int $targetReps;
    public ?int $targetWeight;
    public ?int $targetDuration;
    public ?int $targetDistance;

    public int $numberOfSets = self::DEFAULT_NUMBER_OF_SETS;

    public ?int $targetRest;

    public RoutineDTO $routine;
    public MovementDTO $movement;
    public ?WarmupPatternDTO $warmupPattern;
}