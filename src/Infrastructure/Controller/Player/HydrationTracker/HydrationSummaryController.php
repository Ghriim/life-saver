<?php

namespace App\Infrastructure\Controller\Player\HydrationTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\HydrationTracker\EditHydrationSummaryFormHandler;
use App\UseCase\HydrationTracker\EditHydrationSummaryUseCase;
use App\UseCase\HydrationTracker\GetHydrationSummariesForUserUseCase;
use App\UseCase\HydrationTracker\GetHydrationSummaryForDateUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HydrationSummaryController extends AbstractPlayerController
{
    #[Route('/me/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_current_user', methods: ['GET'])]
    public function getHydrationSummariesForCurrentUser(GetHydrationSummariesForUserUseCase $useCase): Response
    {
        $summaries = $useCase->execute($this->getCurrentUserId());

        return $this->render('player/hydration-tracker/pages/summaries-list.html.twig', ['summaries' => $summaries]);
    }

    #[Route('/{userId}/hydration-tracker/summaries', name: 'page_player_hydration_summaries_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getHydrationSummariesForGivenUser(int $userId, GetHydrationSummariesForUserUseCase $useCase): Response
    {
        $summaries = $useCase->execute($userId);

        return $this->render('player/hydration-tracker/pages/summaries-list.html.twig', ['summaries' => $summaries]);
    }

    #[Route('/{userId}/hydration-tracker/summaries/{date}', name: 'page_player_hydration_summary_for_date', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getHydrationSummaryForDate(int $userId, string $date, GetHydrationSummaryForDateUseCase $useCase): Response
    {
        $summary = $useCase->execute($userId, $date);

        return $this->render('player/hydration-tracker/pages/summaries-details.html.twig', ['summary' => $summary]);
    }

    #[Route('/me/hydration-tracker/summaries/{date}', name: 'page_player_current_user_hydration_summary_for_date', methods: ['GET'])]
    public function getCurrentUserHydrationSummaryForDate(string $date, GetHydrationSummaryForDateUseCase $useCase): Response
    {
        $summary = $useCase->execute($this->getCurrentUserId(), $date);

        return $this->render('player/hydration-tracker/pages/summaries-details.html.twig', ['summary' => $summary]);
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

            return $this->redirectToRoute('page_player_current_user_hydration_summary_for_date', ['date' => $date]);
        }

        return $this->render('player/hydration-tracker/pages/summaries-edit.html.twig', ['form' => $formHandler->getForm()->createView(), 'date' => $date]);
    }
}
