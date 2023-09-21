<?php

namespace App\UseCase\Player\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Domain\Gateway\Persister\TheLibrarian\BookAuthorDTOPersisterGateway;
use App\Domain\Gateway\Persister\TheLibrarian\BookDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheLibrarian\BookDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\TheLibrarian\BookListViewPresenter;
use App\UseCase\UseCaseInterface;
use App\Infrastructure\HttpClient\OpenLibraryHttpClient;

final class GetBooksUseCase implements UseCaseInterface
{
    public function __construct(
        private BookDTOProviderGateway $bookProviderGateway,
        private BookDTOPersisterGateway $bookPersisterGateway,
        private BookAuthorDTOPersisterGateway $bookAuthorPersisterGateway,
        private OpenLibraryHttpClient $libraryClient,
        private BookListViewPresenter $presenter,
    ) {

    }

    public function execute(?array $searchParameters)
    {
        $books = [];
        if (null === $searchParameters) {
            $books = $this->bookProviderGateway->getBooks();
        } else {
            if ($isbn = $searchParameters['isbn']) {
                $book = $this->bookProviderGateway->getBookByISBN($isbn);
                if (null === $book) {
                    $book = $this->handleOpenLibraryBook($isbn);
                }

                $books[] = $book;
            }
        }

        return $this->presenter->present($books);
    }

    private function handleOpenLibraryBook(string $isbn): BookDTO
    {
        $book = $this->libraryClient->fetchBookByISBN($isbn);

        $book->setAuthors( // Author already existing are fetch from the DB
            $this->bookAuthorPersisterGateway->saveBatch($book->getAuthors())
        );

        $this->bookPersisterGateway->save($book);

        return $book;
    }
}