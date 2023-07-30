<?php

namespace App\Infrastructure\Controller\Player;

use App\UseCase\Player\DashboardUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractPlayerController
{
    #[Route('/me/dashboard', name: 'page_player_dashboard', methods: ['GET'])]
    public function dashboard(DashboardUseCase $useCase): Response
    {
        return $this->render(
            'player/dashboard/pages/dashboard.html.twig',
            $useCase->execute($this->getCurrentUserId())
        );
    }
}