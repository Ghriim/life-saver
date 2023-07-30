<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\EquipmentDTO;

interface EquipmentDTOPersisterGateway
{
    public function save(DTOInterface|EquipmentDTO $dto, bool $flush = true): null|DTOInterface|EquipmentDTO;

    public function remove(DTOInterface|EquipmentDTO $dto, bool $flush = true): void;
}