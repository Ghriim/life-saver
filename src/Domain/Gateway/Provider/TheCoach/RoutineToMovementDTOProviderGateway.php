<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;

interface RoutineToMovementDTOProviderGateway
{
    public function getRoutineToMovementById(int $routineToMovementId): ?RoutineToMovementDTO;
}