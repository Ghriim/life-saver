<?php

namespace App\UseCase\Player;

use App\UseCase\Player\ActivityTracker\GetActivitiesForUserUseCase;
use App\UseCase\Player\HydrationTracker\GetHydrationSummaryForDateUseCase;
use App\UseCase\Player\MindTracker\GetLastMoodOfDateForUserUseCase;
use App\UseCase\Player\TheCoach\GetWorkoutsForUserUseCase;
use App\UseCase\UseCaseInterface;
use DateTimeImmutable;

final class DashboardUseCase implements UseCaseInterface
{
    public function __construct(
        private GetLastMoodOfDateForUserUseCase $moodUseCase,
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
            'hydrationSummary' => $this->hydrationUseCase->execute($userId, $todayAsString),
            'mood' => $this->moodUseCase->execute($userId, $today),
            'activities' => $this->activitiesUseCase->execute($userId, $todayAsString),
            'workoutGroups' => $this->workoutsForUserUseCase->execute($userId, GetWorkoutsForUserUseCase::CONTEXT_SPECIFIC_DATE, $todayAsString),
        ];
    }
}