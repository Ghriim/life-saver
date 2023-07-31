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

    public function setEquipments(array $equipments)
    {
        $this->equipments->clear();
        foreach ($equipments as $author) {
            $this->equipments->add($author);
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