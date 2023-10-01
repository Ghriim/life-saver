<?php

namespace App\UseCase\Player;

use App\UseCase\Player\ActivityTracker\GetActivitiesForUserUseCase;
use App\UseCase\Player\BodyTracker\GetSleepsForUserUseCase;
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
        private GetSleepsForUserUseCase $sleepsUseCase,
        private GetActivitiesForUserUseCase $activitiesUseCase,
        private GetWorkoutsForUserUseCase $workoutsForUserUseCase,
    ) {
    }

    public function execute(int $userId): array
    {
        $today = new DateTimeImmutable();

        return [
            'hydrationSummary' => $this->hydrationUseCase->execute($userId, $today),
            'mood' => $this->moodUseCase->execute($userId, $today),
            'sleepGroups' => $this->sleepsUseCase->execute($userId, $today->modify('monday this week'), $today->modify('sunday this week')),
            'activities' => $this->activitiesUseCase->execute($userId, $today),
            'workoutGroups' => $this->workoutsForUserUseCase->execute($userId, GetWorkoutsForUserUseCase::CONTEXT_SPECIFIC_DATE, $today),
        ];
    }
}
