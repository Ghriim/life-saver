<?php

namespace App\Infrastructure\Persister\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Domain\Gateway\Persister\TheLibrarian\BookDTOPersisterGateway;
use App\Infrastructure\Persister\AbstractPersister;

final class BookDTOPersister extends AbstractPersister implements BookDTOPersisterGateway
{
    protected function getEntityClassName(): string
    {
        return BookDTO::class;
    }
}