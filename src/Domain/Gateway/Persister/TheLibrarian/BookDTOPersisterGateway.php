<?php

namespace App\Domain\Gateway\Persister\TheLibrarian;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheLibrarian\BookDTO;

interface BookDTOPersisterGateway
{
    public function save(DTOInterface|BookDTO $dto, bool $flush = true): null|DTOInterface|BookDTO;
}