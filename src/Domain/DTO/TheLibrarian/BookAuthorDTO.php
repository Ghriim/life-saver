<?php

namespace App\Domain\DTO\TheLibrarian;

use App\Domain\DTO\AbstractBaseDTO;

class BookAuthorDTO extends AbstractBaseDTO
{
    public string $fullName;

    public string $openLibraryKey;
}