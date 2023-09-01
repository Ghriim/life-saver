<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\Player\TheCoach\GetWorkoutsForUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractPlayerController
{
    #[Route('/me/the-coach/dashboard', name: 'page_player_coach_dashboard', methods: ['GET'])]
    public function dashboard(): Response
    {
        return $this->render(
            'player/the-coach/pages/dashboard.html.twig',
        );
    }

    #[Route('/me/the-coach/dashboard/history', name: 'page_player_coach_history', methods: ['GET'])]
    public function dashboardHistory(
        Request $request,
        GetWorkoutsForUserUseCase $useCase
    ): Response {
        $date = $request->query->get('date');

        $workouts = $useCase->execute(
            $this->getCurrentUserId(),
            GetWorkoutsForUserUseCase::CONTEXT_HISTORY,
            $date,
        );

        return $this->render(
            'player/the-coach/pages/dashboard-history.html.twig',
            ['workouts' => $workouts]
        );
    }

    #[Route('/me/the-coach/dashboard/workouts', name: 'page_player_coach_planned_workouts', methods: ['GET'])]
    public function dashboardPlannedWorkouts(
        Request $request,
        GetWorkoutsForUserUseCase $useCase
    ): Response {
        $date = $request->query->get('date');

        $workouts = $useCase->execute(
            $this->getCurrentUserId(),
            GetWorkoutsForUserUseCase::CONTEXT_PLANNED,
            $date
        );

        return $this->render(
            'player/the-coach/pages/dashboard-planned-workouts.html.twig',
            ['workouts' => $workouts]
        );
    }
}