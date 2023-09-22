<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Domain\Registry\TheCoach\WorkoutStatusRegistry;
use App\UseCase\Player\TheCoach\Traits\FetchWorkoutForAlterationTrait;
use App\UseCase\UseCaseInterface;

final class StartWorkoutUseCase implements UseCaseInterface
{
    use FetchWorkoutForAlterationTrait;

    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
    ) {
    }

    public function execute(int $workoutId, int $userId): WorkoutDTO
    {
        $workout = $this->fetchWorkout($workoutId, $userId);

        $workout->status = WorkoutStatusRegistry::STATUS_IN_PROGRESS;
        $workout->startedDate = new \DateTimeImmutable();

        $this->workoutDTOPersisterGateway->save($workout);

        return $workout;
    }
}