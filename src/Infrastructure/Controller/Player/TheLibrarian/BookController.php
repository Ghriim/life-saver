<?php

namespace App\Infrastructure\Controller\Player\TheLibrarian;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\TheLibrarian\SearchBooksFormHandler;
use App\UseCase\Player\TheLibrarian\GetBooksUseCase;
use App\UseCase\Player\TheLibrarian\GetBookUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class BookController extends AbstractPlayerController
{
    #[Route('/the-librarian/books', name: 'page_player_books', methods: ['GET', 'POST'])]
    public function getBooks(
        Request $request,
        SearchBooksFormHandler $formHandler,
        GetBooksUseCase $useCase,
    ): Response {
        $formHandler = $formHandler->handle($request);

        $searchResultDisplayed = false;
        $searchParameters = null;
        if (true === $formHandler->isHandledSuccessfully()) {
            $searchParameters = $formHandler->getForm()->getData();
            $searchResultDisplayed = true;
        }

        $books = $useCase->execute($searchParameters);
        if (1 === sizeof($books)) {
            return $this->redirectToRoute('page_player_book', ['bookId' => $books[0]->id]);
        }

        return $this->render(
            'player/the-librarian/pages/book-list.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
                'searchResultDisplayed' => $searchResultDisplayed,
                'books' => $books
            ]
        );
    }

    #[Route('/the-librarian/books/{bookId}', name: 'page_player_book', requirements: ['bookId' => '\d+'], methods: ['GET'])]
    public function getBook(
        int $bookId,
        GetBookUseCase $useCase,
    ): Response {
        return $this->render(
            'player/the-librarian/pages/book-details.html.twig',
            [
                'book' => $useCase->execute($bookId, $this->getCurrentUserId())
            ]
        );
    }
}