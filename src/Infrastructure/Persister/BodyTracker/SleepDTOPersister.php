<?php

namespace App\Infrastructure\Persister\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\DTO\DTOInterface;
use App\Domain\Gateway\Persister\BodyTracker\SleepDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class SleepDTOPersister extends AbstractPersister implements SleepDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return SleepDTO::class;
    }

    /**
     * @param SleepDTO|DTOInterface $dto
     */
    public function save(DTOInterface $dto, bool $flush = true): DTOInterface
    {
        if (null !== $dto->outOfBed) {
            $dto->duration = $dto->outOfBed->getTimestamp() - $dto->inBed->getTimestamp();
        }


        return parent::save($dto, $flush);
    }
}
