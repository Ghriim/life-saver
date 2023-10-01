<?php

namespace App\Infrastructure\Controller\Player\User;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserSummaryController extends AbstractPlayerController
{
    #[Route('/{userId}/user/summaries/{date}', name: 'page_player_user_summary_for_date', requirements: ['userId' => '\d+'], methods: ['GET'])]
    #[Route('/me/user/summaries/today', name: 'page_player_current_user_summary_for_today', methods: ['GET'])]
    #[Route('/me/user/summaries/{date}', name: 'page_player_current_user_summary_for_date', methods: ['GET'])]
    public function getCurrentUserHydrationSummaryForDate(?int $userId, ?string $date, GetUserSummaryForDateUseCase $useCase): Response
    {
        $summary = $useCase->execute(
            $userId ?? $this->getCurrentUserId(),
            new \DateTimeImmutable($date),
        );

        return $this->render('player/user/pages/summary-details.html.twig', ['summary' => $summary]);
    }
}