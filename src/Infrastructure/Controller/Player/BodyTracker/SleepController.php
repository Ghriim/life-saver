<?php

namespace App\Infrastructure\Controller\Player\BodyTracker;

use App\UseCase\BodyTracker\GetSleepsForUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SleepController extends AbstractController
{
    #[Route('/{userId}/sleeps', name: 'page_sleeps_for_user', methods: ['GET'])]
    public function getSleepsForUser(int $userId, GetSleepsForUserUseCase $useCase): Response
    {
        $sleeps = $useCase->execute($userId);

        return $this->render('player/body-tracker/sleep-list.html.twig', ['sleeps' => $sleeps]);
    }
}