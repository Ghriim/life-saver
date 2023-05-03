<?php

namespace App\Domain\Gateway\Provider\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;

interface WeightDTOProviderGateway
{
    public function getWeightById(int $sleepId): ?WeightDTO;

    /**
     * @return WeightDTO[]
     */
    public function getWeightsByUserId(int $userId): array;
}
