<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Domain\Registry\TheCoach\WorkoutStatusRegistry;
use App\UseCase\Player\TheCoach\Traits\FetchWorkoutForAlterationTrait;
use App\UseCase\UseCaseInterface;

final class CompleteWorkoutUseCase implements UseCaseInterface
{
    use FetchWorkoutForAlterationTrait;

    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
    ) {
    }

    public function execute(int $workoutId, int $userId): void
    {
        $workout = $this->fetchWorkout($workoutId, $userId);

        $workout->status = WorkoutStatusRegistry::STATUS_COMPLETED;
        $workout->completedDate = new \DateTimeImmutable();

        $this->workoutDTOPersisterGateway->save($workout);
    }
}