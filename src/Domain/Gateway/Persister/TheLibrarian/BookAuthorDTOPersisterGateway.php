<?php

namespace App\Domain\Gateway\Persister\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookAuthorDTO;

interface BookAuthorDTOPersisterGateway
{
    /**
     * @param BookAuthorDTO[]
     *
     * @return BookAuthorDTO[]
     */
    public function saveBatch(array $dtos, bool $flush = true): array;
}