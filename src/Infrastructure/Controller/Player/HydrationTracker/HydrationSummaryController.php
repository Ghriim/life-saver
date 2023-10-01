<?php

namespace App\Infrastructure\Controller\Player\HydrationTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\HydrationTracker\EditHydrationSummaryFormHandler;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\UseCase\Player\HydrationTracker\EditHydrationSummaryUseCase;
use App\UseCase\Player\HydrationTracker\GetHydrationSummariesForUserUseCase;
use App\UseCase\Player\HydrationTracker\GetHydrationSummaryForDateUseCase;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HydrationSummaryController extends AbstractPlayerController
{
    #[Route('/me/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_current_user', methods: ['GET'])]
    #[Route('/{userId}/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getHydrationSummariesForGivenUser(?int $userId, GetHydrationSummariesForUserUseCase $useCase): Response
    {
        $summaries = $useCase->execute($userId ?? $this->getCurrentUserId());

        return $this->render('player/hydration-tracker/pages/summary-list.html.twig', ['summaries' => $summaries]);
    }

    #[Route('/{userId}/hydration-tracker/summaries/{date}', name: 'page_player_hydration_summary_for_date', requirements: ['userId' => '\d+'], methods: ['GET'])]
    #[Route('/me/hydration-tracker/summaries/today', name: 'page_player_current_user_hydration_summary_for_today', methods: ['GET'])]
    #[Route('/me/hydration-tracker/summaries/{date}', name: 'page_player_current_user_hydration_summary_for_date', methods: ['GET'])]
    public function getCurrentUserHydrationSummaryForDate(?int $userId, ?string $date, GetHydrationSummaryForDateUseCase $useCase): Response
    {
        $summary = $useCase->execute(
            $userId ?? $this->getCurrentUserId(),
            new DateTimeImmutable($date),
        );

        return $this->render('player/hydration-tracker/pages/summary-details.html.twig', ['summary' => $summary]);
    }

    #[Route('/me/hydration-tracker/summaries/{date}/edit', name: 'page_player_hydration_summary_edit', methods: ['GET', 'POST'])]
    public function editHydrationSummary(
        string $date,
        Request $request,
        EditHydrationSummaryFormHandler $formHandler,
        EditHydrationSummaryUseCase $useCase
    ): Response {
        $request->attributes->set('userId', $this->getCurrentUserId());

        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto());

            return $this->redirectTo($request,  'page_player_current_user_hydration_summary_for_date', ['date' => $date]);
        }

        return $this->render('player/hydration-tracker/pages/summary-edit.html.twig', ['form' => $formHandler->getForm()->createView(), 'date' => $date]);
    }
}
