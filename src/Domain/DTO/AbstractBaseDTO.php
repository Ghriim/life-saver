<?php

namespace App\Domain\DTO;

use \DateTimeImmutable;

abstract class AbstractBaseDTO implements DTOInterface
{
    public ?int $id = null;

    public DateTimeImmutable $createDate;
    public DateTimeImmutable $updateDate;
}