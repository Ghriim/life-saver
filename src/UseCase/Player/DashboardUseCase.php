<?php

namespace App\UseCase\Player;

use App\UseCase\Player\ActivityTracker\GetActivitiesForUserUseCase;
use App\UseCase\Player\HydrationTracker\GetHydrationSummaryForDateUseCase;
use App\UseCase\Player\MindTracker\GetMoodsForUserUseCase;
use App\UseCase\Player\TheCoach\GetWorkoutsForUserUseCase;
use App\UseCase\UseCaseInterface;
use DateTimeImmutable;

final class DashboardUseCase implements UseCaseInterface
{
    public function __construct(
        private GetMoodsForUserUseCase $moodsUseCase,
        private GetHydrationSummaryForDateUseCase $hydrationUseCase,
        private GetActivitiesForUserUseCase $activitiesUseCase,
        private GetWorkoutsForUserUseCase $workoutsForUserUseCase,
    ) {
    }

    public function execute(int $userId): array
    {
        $today = new DateTimeImmutable();
        $todayAsString = $today->format('Y-m-d');

        return [
            'moods' => $this->moodsUseCase->execute($userId, $todayAsString),
            'hydrationSummary' => $this->hydrationUseCase->execute($userId, $todayAsString),
            'activities' => $this->activitiesUseCase->execute($userId, $todayAsString),
            'workouts' => $this->workoutsForUserUseCase->execute($userId, GetWorkoutsForUserUseCase::CONTEXT_SPECIFIC_DATE, $todayAsString),
        ];
    }
}