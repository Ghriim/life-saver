<?php

namespace App\Domain\Gateway\Provider\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;

interface BookDTOProviderGateway
{
    /**
     * @return BookDTO[]
     */
    public function getBooks(?int $authorId = null, ?string $title = null): array;

    public function getBookByIdAndUserId(int $bookId, int $userId): ?BookDTO;

    public function getBookByISBN(string $isbn): ?BookDTO;
}