<?php

namespace App\UseCase\TheLibrarian;

use App\Domain\Gateway\Provider\TheLibrarian\BookDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\TheLibrarian\BookDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetBookUseCase implements UseCaseInterface
{
    public function __construct(
        private BookDTOProviderGateway $providerGateway,
        private BookDetailsViewPresenter $presenter,
    ) {
    }

    public function execute(int $bookId)
    {
        $book = $this->providerGateway->getBookById($bookId);
        if (null === $book) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($book);
    }
}