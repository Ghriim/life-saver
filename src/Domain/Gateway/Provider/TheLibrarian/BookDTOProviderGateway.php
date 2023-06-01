<?php

namespace App\Domain\Gateway\Provider\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;

interface BookDTOProviderGateway
{
    /**
     * @return BookDTO[]
     */
    public function getBooks(?int $authorId = null, ?string $title = null): array;

    public function getBookById(int $bookId): ?BookDTO;

    public function getBookByISBN(string $isbn): ?BookDTO;
}