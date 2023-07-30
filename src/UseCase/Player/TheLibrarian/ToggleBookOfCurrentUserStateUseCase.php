<?php

namespace App\UseCase\Player\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookOfUserDTO;
use App\Domain\Gateway\Persister\TheLibrarian\BookOfUserDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheLibrarian\BookDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ToggleBookOfCurrentUserStateUseCase implements UseCaseInterface
{
    public function __construct(
        private BookDTOProviderGateway $bookProviderGateway,
        private BookOfUserDTOPersisterGateway $persisterGateway,
    ) {

    }
    public function execute(int $bookId, int $userId, string $state): void
    {
        $book = $this->bookProviderGateway->getBookByIdAndUserId($bookId, $userId);
        if (null === $book) {
            throw new NotFoundHttpException();
        }

        $bookOfUser = $book->getBookOfUser($userId);
        $propertyName = 'is'.ucfirst($state);
        if (null === $bookOfUser) {
            $bookOfUser = new BookOfUserDTO();
            $bookOfUser->book = $book;
            $bookOfUser->userId = $userId;
            $bookOfUser->{$propertyName} = true;
        } else {
            $bookOfUser->{$propertyName} = !(true === $bookOfUser->{$propertyName});
        }

        $this->persisterGateway->save($bookOfUser);
    }
}