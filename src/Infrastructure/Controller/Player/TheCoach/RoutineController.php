<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\Player\TheCoach\GetRoutinesUseCase;
use App\UseCase\Player\TheCoach\GetRoutineUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RoutineController extends AbstractPlayerController
{
    #[Route('/the-coach/routines', name: 'page_player_routines', methods: ['GET'])]
    public function getRoutines(
        GetRoutinesUseCase $useCase
    ): Response {
        return $this->render(
            'player/the-coach/pages/routine-list.html.twig',
            [
                'routines' => $useCase->execute($this->getCurrentUserId()),
            ]
        );
    }

    #[Route('/the-coach/routines/{routineId}', name: 'page_player_routine', requirements: ['routineId' => '\d+'], methods: ['GET'])]
    public function getRoutine(
        int $routineId,
        GetRoutineUseCase $useCase
    ): Response {
        return $this->render(
            'player/the-coach/pages/routine-details.html.twig',
            [
                'routine' => $useCase->execute($routineId),
            ]
        );
    }
}