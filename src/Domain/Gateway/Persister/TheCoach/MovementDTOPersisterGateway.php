<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\MovementDTO;

interface MovementDTOPersisterGateway
{
    public function save(DTOInterface|MovementDTO $dto, bool $flush = true): null|DTOInterface|MovementDTO;

    public function remove(DTOInterface|MovementDTO $dto, bool $flush = true): void;
}