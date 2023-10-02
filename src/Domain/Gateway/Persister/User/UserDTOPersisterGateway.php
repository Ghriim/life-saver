<?php

namespace App\Domain\Gateway\Persister\User;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\User\UserDTO;

interface UserDTOPersisterGateway
{
    public function save(DTOInterface|UserDTO $dto, bool $flush = true): null|DTOInterface|UserDTO;

    public function remove(DTOInterface|UserDTO $dto, bool $flush = true): void;
}