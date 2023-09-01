<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use \DateTimeImmutable;

interface WorkoutDTOProviderGateway
{
    public function getWorkoutById(int $workoutId): ?WorkoutDTO;

    /**
     * @return WorkoutDTO[]
     */
    public function getWorkoutsByUserId(int $userId): array;

    /**
     * @return WorkoutDTO[]
     */
    public function getWorkoutsHistoryByUserIdAndDate(int $userId, DateTimeImmutable $date): array;

    /**
     * @return WorkoutDTO[]
     */
    public function getWorkoutsPlannedByUserIdAndDate(int $userId, DateTimeImmutable $date): array;
}