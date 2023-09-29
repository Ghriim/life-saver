<?php

namespace App\Infrastructure\Controller\Player\BodyTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\BodyTracker\SaveSleepFormHandler;
use App\UseCase\Player\BodyTracker\DeleteSleepUseCase;
use App\UseCase\Player\BodyTracker\SaveSleepUseCase;
use App\UseCase\Player\BodyTracker\GetSleepsForUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SleepController extends AbstractPlayerController
{
    #[Route('/me/body-tracker/sleeps', name: 'page_player_sleeps_for_current_user', methods: ['GET'])]
    #[Route('/{userId}/body-tracker/sleeps', name: 'page_player_sleeps_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getSleepsForGivenUser(
        ?int $userId,
        Request $request,
        GetSleepsForUserUseCase $useCase
    ): Response {
        $sleeps = $useCase->execute(
            $userId ?? $this->getCurrentUserId(),
            $request->query->get('dateStart'),
            $request->query->get('dateEnd')
        );

        return $this->render('player/body-tracker/pages/sleep-list.html.twig', ['sleepGroups' => $sleeps]);
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

            return $this->redirectTo($request,  'page_player_sleeps_for_current_user');
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

            return $this->redirectTo($request,  'page_player_sleeps_for_current_user');
        }

        return $this->render('player/body-tracker/pages/sleep-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/body-tracker/sleeps/{sleepId}/delete', name: 'page_player_sleep_delete', requirements: ['sleepId' => '\d+'], methods: ['GET'])]
    public function deleteSleep(
        int $sleepId,
        Request $request,
        DeleteSleepUseCase $useCase
    ): Response {
        $useCase->execute($sleepId);

        return $this->redirectTo($request,  'page_player_sleeps_for_current_user');
    }
}