<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class RoutineDTO extends AbstractBaseDTO
{
    public string $title;

    private Collection $movements;

    public function __construct()
    {
        $this->movements = new ArrayCollection();
    }

    public function addMovement(MovementDTO $movementDTO)
    {
        $this->movements->add($movementDTO);
    }

    /**
     * @return MovementDTO[]
     */
    public function getMovements(): array
    {
        return $this->movements->toArray();
    }
}