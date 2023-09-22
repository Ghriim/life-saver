<?php

namespace App\UseCase\Player\TheCoach\Traits;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait FetchWorkoutForAlterationTrait
{
    protected function fetchWorkout(int $workoutId, int $userId): WorkoutDTO
    {
        $workout = $this->workoutDTOProviderGateway->getWorkoutById($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        if ($userId !== $workout->userId) {
            throw new AccessDeniedHttpException();
        }

        return $workout;
    }
}