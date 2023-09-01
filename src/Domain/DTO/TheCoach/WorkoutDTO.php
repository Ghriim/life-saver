<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class WorkoutDTO extends AbstractBaseDTO
{
    public string $title;

    public ?DateTimeImmutable $plannedDate = null;
    public ?DateTimeImmutable $startedDate = null;
    public ?DateTimeImmutable $completedDate = null;

    public int $userId;

    private Collection $exercises;

    public ?RoutineDTO $routine = null;

}