<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;

class RoutineDTO extends AbstractBaseDTO
{
    public string $title;

    /**
     * @var MovementDTO[]
     */
    public array $movements;
}