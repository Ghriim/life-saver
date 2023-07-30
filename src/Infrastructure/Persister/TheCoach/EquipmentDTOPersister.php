<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Domain\Gateway\Persister\TheCoach\EquipmentDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class EquipmentDTOPersister extends AbstractPersister implements EquipmentDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return EquipmentDTO::class;
    }
}