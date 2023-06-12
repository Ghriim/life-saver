<?php

namespace App\Infrastructure\Persister\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookOfUserDTO;
use App\Domain\Gateway\Persister\TheLibrarian\BookOfUserDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class BookOfUserDTOPersister extends AbstractPersister implements BookOfUserDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return BookOfUserDTO::class;
    }
}