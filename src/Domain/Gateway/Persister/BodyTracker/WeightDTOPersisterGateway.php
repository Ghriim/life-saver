<?php

namespace App\Domain\Gateway\Persister\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Domain\DTO\DTOInterface;

interface WeightDTOPersisterGateway
{
    public function save(DTOInterface|WeightDTO $dto, bool $flush = true): null|DTOInterface|WeightDTO;

    public function remove(DTOInterface|WeightDTO $dto, bool $flush = true): void;
}