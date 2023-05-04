<?php

namespace App\Infrastructure\Persister\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Domain\Gateway\Persister\BodyTracker\WeightDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class WeightDTOPersister extends AbstractPersister implements WeightDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return WeightDTO::class;
    }
}
