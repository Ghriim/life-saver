<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;

interface MovementDTOProviderGateway
{
    /**
     * @return MovementDTO[]
     */
    public function getMovements(?string $name): array;

    public function getMovementById(int $movementId): ?MovementDTO;
}