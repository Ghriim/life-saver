<?php

namespace App\Infrastructure\Controller\Player\TheLibrarian;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\Player\TheLibrarian\ToggleBookOfCurrentUserStateUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class BookOfUserController extends AbstractPlayerController
{
    #[Route('/the-librarian/books/{bookId}/{state}', name: 'page_player_book_of_user_toggle_state', requirements: ['bookId' => '\d+', 'state' => 'wishlist|owned|reading|read|liked'], methods: ['POST'])]
    public function toggleState(int $bookId, string $state, ToggleBookOfCurrentUserStateUseCase $useCase): Response
    {
        $useCase->execute(
            $bookId,
            $this->getCurrentUserId(),
            $state
        );

        return $this->redirectToRoute('page_player_book', ['bookId' => $bookId]);
    }
}