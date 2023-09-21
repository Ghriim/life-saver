<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class WorkoutDTO extends AbstractBaseDTO
{
    public string $title;
    public string $status;

    public ?DateTimeImmutable $plannedDate = null;
    public ?DateTimeImmutable $startedDate = null;
    public ?DateTimeImmutable $completedDate = null;

    public int $userId;

    private Collection $exercises;

    public ?RoutineDTO $routine = null;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }

    public function addExercise(ExerciseDTO $exercise)
    {
        $this->exercises->add($exercise);
    }

    /**
     * @return ExerciseDTO[]
     */
    public function getExercises(): array
    {
        return $this->exercises->toArray();
    }
}