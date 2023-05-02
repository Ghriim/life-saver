<?php

namespace App\Domain\Gateway\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;

interface GetSleepDTOGateway
{
    /**
     * @return SleepDTO[]
     */
    public function getSleepsByUserId(int $userId): array;
}
