<?php

namespace App\Infrastructure\Persister\TheLibrarian;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheLibrarian\BookAuthorDTO;
use App\Domain\Gateway\Persister\TheLibrarian\BookAuthorDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheLibrarian\BookAuthorDTOProviderGateway;
use App\Infrastructure\Persister\AbstractPersister;
use Doctrine\Persistence\ManagerRegistry;

final class BookAuthorDTOPersister extends AbstractPersister implements BookAuthorDTOPersisterGateway
{
    public function __construct(
        private BookAuthorDTOProviderGateway $authorProviderGateway,
        ManagerRegistry $doctrine,
    ) {
        parent::__construct($doctrine);
    }

    protected function getEntityClassName(): string
    {
        return BookAuthorDTO::class;
    }

    public function saveBatch(array $dtos, bool $flush = true): array
    {
        $authors = [];
        foreach ($dtos as $dto) {
            $author = $this->authorProviderGateway->getAuthorByOpenLibraryKey($dto->openLibraryKey);
            if (null === $author) {
                $author = parent::save($dto, $flush);
            }

            $authors[] = $author;
        }

        return $authors;
    }
}