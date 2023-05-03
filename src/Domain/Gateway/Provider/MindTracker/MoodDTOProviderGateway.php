<?php

namespace App\Domain\Gateway\Provider\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;

interface MoodDTOProviderGateway
{
    public function getMoodById(int $sleepId): ?MoodDTO;

    /**
     * @return MoodDTO[]
     */
    public function getMoodsByUserId(int $userId): array;
}
