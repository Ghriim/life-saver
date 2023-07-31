<?php

namespace App\Infrastructure\Persister\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\Gateway\Persister\TheCoach\MovementDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class MovementDTOPersister extends AbstractPersister implements MovementDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return MovementDTO::class;
    }
}