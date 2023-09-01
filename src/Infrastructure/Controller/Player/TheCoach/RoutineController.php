<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\Player\TheCoach\DashboardRoutinesUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RoutineController extends AbstractPlayerController
{
    #[Route('/the-coach/routines', name: 'page_player_coach_routines', methods: ['GET'])]
    public function getRoutines(
        DashboardRoutinesUseCase $useCase
    ): Response {
        return $this->render(
            'player/the-coach/pages/routine-list.html.twig',
            [
                'routines' => $useCase->execute($this->getCurrentUserId()),
            ]
        );
    }
}