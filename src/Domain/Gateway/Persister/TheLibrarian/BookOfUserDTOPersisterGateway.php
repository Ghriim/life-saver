<?php

namespace App\Domain\Gateway\Persister\TheLibrarian;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheLibrarian\BookOfUserDTO;

interface BookOfUserDTOPersisterGateway
{
    public function save(DTOInterface|BookOfUserDTO $dto, bool $flush = true): null|DTOInterface|BookOfUserDTO;
}