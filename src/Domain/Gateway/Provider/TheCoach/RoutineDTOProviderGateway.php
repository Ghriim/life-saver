<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;

interface RoutineDTOProviderGateway
{
    /**
     * @return RoutineDTO[]
     */
    public function getRoutines(?string $title): array;

    public function getRoutineById(int $routineId): ?RoutineDTO;
}