<?php

namespace App\Domain\Gateway\Provider\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;

interface SleepDTOProviderGateway
{
    public function getSleepById(int $sleepId): ?SleepDTO;

    /**
     * @return SleepDTO[]
     */
    public function getSleepsByUserId(int $userId, ?\DateTimeImmutable $dateStart, ?\DateTimeImmutable $dateEnd): array;
}
