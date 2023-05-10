<?php

namespace App\Infrastructure\Controller\Player\ActivityTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\ActivityTracker\SaveActivityFormHandler;
use App\UseCase\ActivityTracker\DeleteActivityUseCase;
use App\UseCase\ActivityTracker\GetActivitiesForUserUseCase;
use App\UseCase\ActivityTracker\SaveActivityUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ActivityController extends AbstractPlayerController
{
    #[Route('/me/activity-tracker/activities', name: 'page_player_activities_for_current_user', methods: ['GET'])]
    #[Route('/{userId}/activity-tracker/activities', name: 'page_player_activities_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getActivitiesForGivenUser(?int $userId, Request $request, GetActivitiesForUserUseCase $useCase): Response
    {
        $activities = $useCase->execute(
            $userId ?? $this->getCurrentUserId(),
            $request->query->get('date')
        );

        return $this->render('player/activity-tracker/pages/activity-list.html.twig', ['activities' => $activities]);
    }

    #[Route('/me/activity-tracker/activities/add', name: 'page_player_activity_add', methods: ['GET', 'POST'])]
    public function addActivity(
        Request $request,
        SaveActivityFormHandler $formHandler,
        SaveActivityUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_activities_for_current_user');
        }

        return $this->render('player/activity-tracker/pages/activity-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/activity-tracker/activities/{activityId}/edit', name: 'page_player_activity_edit', requirements: ['activityId' => '\d+'], methods: ['GET', 'POST'])]
    public function editActivity(
        Request $request,
        SaveActivityFormHandler $formHandler,
        SaveActivityUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_activities_for_current_user');
        }

        return $this->render('player/activity-tracker/pages/activity-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/activity-tracker/activities/{activityId}/delete', name: 'page_player_activity_delete', requirements: ['activityId' => '\d+'], methods: ['GET'])]
    public function deleteActivity(
        int $activityId,
        DeleteActivityUseCase $useCase
    ): Response {
        $useCase->execute($activityId);

        return $this->redirectToRoute('page_player_activities_for_current_user');
    }
}