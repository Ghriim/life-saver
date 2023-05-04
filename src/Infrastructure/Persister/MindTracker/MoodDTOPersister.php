<?php

namespace App\Infrastructure\Persister\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\Gateway\Persister\MindTracker\MoodDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class MoodDTOPersister extends AbstractPersister implements MoodDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return MoodDTO::class;
    }
}
