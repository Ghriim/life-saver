<?php

namespace App\Infrastructure\Controller\Player\MindTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\MindTracker\SaveMoodFormHandler;
use App\UseCase\MindTracker\DeleteMoodUseCase;
use App\UseCase\MindTracker\GetMoodsForUserUseCase;
use App\UseCase\MindTracker\SaveMoodUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MoodController extends AbstractPlayerController
{
    #[Route('/me/mind-tracker/moods', name: 'page_player_moods_for_current_user', methods: ['GET'])]
    #[Route('/{userId}/mind-tracker/moods', name: 'page_player_moods_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getMoodsForGivenUser(?int $userId, Request $request, GetMoodsForUserUseCase $useCase): Response
    {
        $moods = $useCase->execute(
            $userId ?? $this->getCurrentUserId(),
            $request->query->get('date')
        );

        return $this->render('player/mind-tracker/pages/mood-list.html.twig', ['moods' => $moods]);
    }

    #[Route('/me/mind-tracker/moods/add', name: 'page_player_mood_add', methods: ['GET', 'POST'])]
    public function addMood(
        Request $request,
        SaveMoodFormHandler $formHandler,
        SaveMoodUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectTo($request, 'page_player_moods_for_current_user');
        }

        return $this->render('player/mind-tracker/pages/mood-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/mind-tracker/moods/{moodId}/edit', name: 'page_player_mood_edit', requirements: ['moodId' => '\d+'], methods: ['GET', 'POST'])]
    public function editMood(
        Request $request,
        SaveMoodFormHandler $formHandler,
        SaveMoodUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_moods_for_current_user');
        }

        return $this->render('player/mind-tracker/pages/mood-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/mind-tracker/moods/{moodId}/delete', name: 'page_player_mood_delete', requirements: ['moodId' => '\d+'], methods: ['GET'])]
    public function deleteMood(
        int $moodId,
        DeleteMoodUseCase $useCase
    ): Response {
        $useCase->execute($moodId);

        return $this->redirectToRoute('page_player_moods_for_current_user');
    }
}