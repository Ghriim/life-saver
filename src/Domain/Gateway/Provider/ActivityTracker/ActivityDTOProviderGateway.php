<?php

namespace App\Domain\Gateway\Provider\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use DateTimeImmutable;

interface ActivityDTOProviderGateway
{
    public function getActivityById(int $activityId): ?ActivityDTO;

    /**
     * @return ActivityDTO[]
     */
    public function getActivitiesByUserIdAndDate(int $userId, DateTimeImmutable $date): array;

    /**
     * @return ActivityDTO[]
     */
    public function getActivitiesByUserId(int $userId): array;
}