<?php

namespace App\Infrastructure\Controller\Player\HydrationTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\HydrationTracker\GetHydrationSummariesForUserUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HydrationSummaryController extends AbstractPlayerController
{
    #[Route('/me/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_current_user', methods: ['GET'])]
    public function getMoodsForCurrentUser(GetHydrationSummariesForUserUseCase $useCase): Response
    {
        $summaries = $useCase->execute($this->getCurrentUserId());

        return $this->render('player/hydration-tracker/pages/summaries-list.html.twig', ['summaries' => $summaries]);
    }

    #[Route('/{userId}/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getMoodsForGivenUser(int $userId, GetHydrationSummariesForUserUseCase $useCase): Response
    {
        $summaries = $useCase->execute($userId);

        return $this->render('player/hydration-tracker/pages/summaries-list.html.twig', ['summaries' => $summaries]);
    }
}