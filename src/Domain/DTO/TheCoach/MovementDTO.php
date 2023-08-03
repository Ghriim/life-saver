<?php

namespace App\Domain\DTO\TheCoach;

use App\Domain\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class MovementDTO extends AbstractBaseDTO
{
    public string $name;
    public string $image = '';

    private Collection $equipments;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
    }

    public function addEquipment(EquipmentDTO $equipmentDTO): void
    {
        $this->equipments->add($equipmentDTO);
    }

    public function removeEquipment(int $equipmentId): void
    {
        foreach ($this->getEquipments() as $equipment) {
            if ($equipmentId === $equipment->id) {
                $this->equipments->removeElement($equipment);
            }
        }
    }

    /**
     * @return EquipmentDTO[]
     */
    public function getEquipments(): array
    {
        return $this->equipments->toArray();
    }
}