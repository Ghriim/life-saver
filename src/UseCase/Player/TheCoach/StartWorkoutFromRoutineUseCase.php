<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Domain\Registry\TheCoach\WorkoutStatusRegistry;
use App\Infrastructure\Factory\DTOFactory\TheCoach\WorkoutDTOFactory;
use App\UseCase\Player\TheCoach\Traits\CreateWorkoutTrait;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class StartWorkoutFromRoutineUseCase implements UseCaseInterface
{
    use CreateWorkoutTrait;

    public function __construct(
        private RoutineDTOProviderGateway $routineDTOProviderGateway,
        private WorkoutDTOFactory $workoutDTOFactory,
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
    ) {

    }

    public function execute(int $routineId, int $userId): WorkoutDTO
    {
        $routine = $this->routineDTOProviderGateway->getRoutineById($routineId);
        if (null === $routine) {
            throw new NotFoundHttpException();
        }

        $workout = $this->workoutDTOFactory->buildFromRoutine($routine);
        $workout->status = WorkoutStatusRegistry::STATUS_IN_PROGRESS;
        $workout->startedDate = new \DateTimeImmutable();

        return $this->createWorkout($workout, $userId);
    }
}