<?php

namespace App\Domain\Gateway\Persister\User;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\User\UserSummaryDTO;

interface UserSummaryDTOPersisterGateway
{
    public function save(DTOInterface|UserSummaryDTO $dto, bool $flush = true): null|DTOInterface|UserSummaryDTO;

    public function remove(DTOInterface|UserSummaryDTO $dto, bool $flush = true): void;
}