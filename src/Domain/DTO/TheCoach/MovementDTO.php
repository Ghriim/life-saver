<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;

class MovementDTO extends AbstractBaseDTO
{
    public string $name;

    public string $image;

    /**
     * @var EquipmentDTO[]
     */
    public array $equipments;
}