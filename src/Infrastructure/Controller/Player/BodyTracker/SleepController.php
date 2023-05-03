<?php

namespace App\Infrastructure\Controller\Player\BodyTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\BodyTracker\SaveSleepFormHandler;
use App\UseCase\BodyTracker\DeleteSleepUseCase;
use App\UseCase\BodyTracker\SaveSleepUseCase;
use App\UseCase\BodyTracker\GetSleepsForUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SleepController extends AbstractPlayerController
{
    #[Route('/me/body-tracker/sleeps', name: 'page_player_sleeps_for_current_user', methods: ['GET'])]
    public function getSleepsForCurrentUser(GetSleepsForUserUseCase $useCase): Response
    {
        $sleeps = $useCase->execute($this->getCurrentUserId());

        return $this->render('player/body-tracker/pages/sleep-list.html.twig', ['sleeps' => $sleeps]);
    }

    #[Route('/{userId}/body-tracker/sleeps', name: 'page_player_sleeps_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getSleepsForGivenUser(int $userId, GetSleepsForUserUseCase $useCase): Response
    {
        $sleeps = $useCase->execute($userId);

        return $this->render('player/body-tracker/pages/sleep-list.html.twig', ['sleeps' => $sleeps]);
    }

    #[Route('/me/body-tracker/sleeps/add', name: 'page_player_sleep_add', methods: ['GET', 'POST'])]
    public function addSleep(
        Request $request,
        SaveSleepFormHandler $formHandler,
        SaveSleepUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_sleeps_for_current_user');
        }

        return $this->render('player/body-tracker/pages/sleep-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/body-tracker/sleeps/{sleepId}/edit', name: 'page_player_sleep_edit', requirements: ['sleepId' => '\d+'], methods: ['GET', 'POST'])]
    public function editSleep(
        Request $request,
        SaveSleepFormHandler $formHandler,
        SaveSleepUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_sleeps_for_current_user');
        }

        return $this->render('player/body-tracker/pages/sleep-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/body-tracker/sleeps/{sleepId}/delete', name: 'page_player_sleep_delete', requirements: ['sleepId' => '\d+'], methods: ['GET'])]
    public function deleteSleep(
        int $sleepId,
        DeleteSleepUseCase $useCase
    ): Response {
        $useCase->execute($sleepId);

        return $this->redirectToRoute('page_player_sleeps_for_current_user');
    }
}