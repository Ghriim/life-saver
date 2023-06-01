<?php

namespace App\Domain\Gateway\Provider\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookAuthorDTO;

interface BookAuthorDTOProviderGateway
{
    public function getAuthorByOpenLibraryKey(string $openLibraryKey): ?BookAuthorDTO;
}