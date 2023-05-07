<?php

namespace App\Infrastructure\Controller\Player\HydrationTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\HydrationTracker\DeleteHydrationIntakeUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HydrationIntakeController extends AbstractPlayerController
{
    #[Route('/me/hydration-tracker/summaries/{date}/intakes/{intakeId}/add', name: 'page_player_hydration_intake_add', requirements: ['intakeId' => '\d+'], methods: ['GET', 'POST'])]
    public function addHydrationIntake(Request $request): Response
    {
        return $this->redirectToRoute(
            'page_player_current_user_hydration_summary_for_date',
            ['date' => null]
        );
    }

    #[Route('/me/hydration-tracker/summaries/{date}/intakes/{intakeId}/delete', name: 'page_player_hydration_intake_delete', requirements: ['intakeId' => '\d+'], methods: ['GET'])]
    public function deleteHydrationIntake(string $date, int $intakeId, DeleteHydrationIntakeUseCase $useCase): Response
    {
        $useCase->execute(
            $this->getCurrentUserId(),
            $intakeId
        );

        return $this->redirectToRoute(
            'page_player_current_user_hydration_summary_for_date',
            ['date' => $date]
        );
    }
}