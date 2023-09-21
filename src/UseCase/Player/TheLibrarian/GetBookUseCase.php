<?php

namespace App\UseCase\Player\TheLibrarian;

use App\Domain\Gateway\Provider\TheLibrarian\BookDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\TheLibrarian\BookDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetBookUseCase implements UseCaseInterface
{
    public function __construct(
        private BookDTOProviderGateway $providerGateway,
        private BookDetailsViewPresenter $presenter,
    ) {
    }

    public function execute(int $bookId, int $currentUserId)
    {
        $book = $this->providerGateway->getBookByIdAndUserId($bookId, $currentUserId);
        if (null === $book) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($book, $currentUserId);
    }
}