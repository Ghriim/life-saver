<?php

namespace App\Infrastructure\Controller\Player;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractPlayerController
{
    #[Route('/me/dashboard', name: 'page_player_dashboard', methods: ['GET'])]
    public function dashboard(): Response
    {
        return $this->render('player/dashboard.html.twig');
    }
}