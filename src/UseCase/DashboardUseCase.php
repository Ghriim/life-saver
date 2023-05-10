<?php

namespace App\UseCase;

use App\UseCase\ActivityTracker\GetActivitiesForUserUseCase;
use App\UseCase\HydrationTracker\GetHydrationSummaryForDateUseCase;
use App\UseCase\MindTracker\GetMoodsForUserUseCase;
use DateTimeImmutable;

final class DashboardUseCase implements UseCaseInterface
{
    public function __construct(
        private GetMoodsForUserUseCase $moodsUseCase,
        private GetHydrationSummaryForDateUseCase $hydrationUseCase,
        private GetActivitiesForUserUseCase $activitiesUseCase
    ) {
    }

    public function execute(int $userId): array
    {
        $today = new DateTimeImmutable();
        $todayAsString = $today->format('Y-m-d');

        return [
            'moods' => $this->moodsUseCase->execute($userId, $todayAsString),
            'hydrationSummary' => $this->hydrationUseCase->execute($userId, $todayAsString),
            'activities' => $this->activitiesUseCase->execute($userId, $todayAsString)
        ];
    }
}