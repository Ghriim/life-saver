<?php

namespace App\Infrastructure\Controller\Player\MindTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\MindTracker\GetMoodsForUserUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MoodController extends AbstractPlayerController
{
    #[Route('/me/mind-tracker/moods', name: 'page_player_moods_for_current_user', methods: ['GET'])]
    public function getMoodsForCurrentUser(GetMoodsForUserUseCase $useCase): Response
    {
        $moods = $useCase->execute($this->getCurrentUserId());

        return $this->render('player/mind-tracker/pages/mood-list.html.twig', ['moods' => $moods]);
    }

    #[Route('/{userId}/mind-tracker/moods', name: 'page_player_moods_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getMoodsForGivenUser(int $userId, GetMoodsForUserUseCase $useCase): Response
    {
        $moods = $useCase->execute($userId);

        return $this->render('player/mind-tracker/pages/mood-list.html.twig', ['moods' => $moods]);
    }
}