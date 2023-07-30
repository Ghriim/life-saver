<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;

interface EquipmentDTOProviderGateway
{
    /**
     * @return EquipmentDTO[]
     */
    public function getEquipments(?string $name): array;
}