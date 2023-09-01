<?php

namespace App\UseCase\Player\TheCoach\Traits;

use App\Domain\DTO\TheCoach\WorkoutDTO;

trait CreateWorkoutTrait
{
    public function createWorkout(WorkoutDTO $workout, int $userId): WorkoutDTO
    {
        $workout->userId = $userId;

        $this->workoutDTOPersisterGateway->save($workout);

        return $workout;
    }
}