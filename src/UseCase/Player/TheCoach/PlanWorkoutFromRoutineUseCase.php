<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\UseCase\Player\TheCoach\Traits\CreateWorkoutTrait;
use App\UseCase\UseCaseInterface;

final class PlanWorkoutFromRoutineUseCase implements UseCaseInterface
{
    use CreateWorkoutTrait;

    public function __construct(
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
    ) {

    }

    public function execute(WorkoutDTO $workout, int $userId): WorkoutDTO
    {
        return $this->createWorkout($workout, $userId);
    }
}