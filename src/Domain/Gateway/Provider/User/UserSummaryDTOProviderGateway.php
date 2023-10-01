<?php

namespace App\Domain\Gateway\Provider\User;

use App\Domain\DTO\User\UserSummaryDTO;
use DateTimeImmutable;

interface UserSummaryDTOProviderGateway
{
    public function getUserSummaryByUserIdAndDate(int $userId, DateTimeImmutable $date): ?UserSummaryDTO;
}
