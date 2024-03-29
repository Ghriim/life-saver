<?php

namespace App\Infrastructure\Controller\Player\BodyTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\BodyTracker\SaveWeightFormHandler;
use App\UseCase\Player\BodyTracker\DeleteWeightUseCase;
use App\UseCase\Player\BodyTracker\GetWeightsForUserUseCase;
use App\UseCase\Player\BodyTracker\SaveWeightUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WeightController extends AbstractPlayerController
{
    #[Route('/me/body-tracker/weights', name: 'page_player_weights_for_current_user', methods: ['GET'])]
    #[Route('/{userId}/body-tracker/weights', name: 'page_player_weights_for_user', requirements: ['userId' => '\d+'], methods: ['GET'])]
    public function getWeightsForGivenUser(?int $userId, GetWeightsForUserUseCase $useCase): Response
    {
        $weights = $useCase->execute($userId ?? $this->getCurrentUserId());

        return $this->render('player/body-tracker/pages/weight-list.html.twig', ['weights' => $weights]);
    }

    #[Route('/me/body-tracker/weights/add', name: 'page_player_weight_add', methods: ['GET', 'POST'])]
    public function addWeight(
        Request $request,
        SaveWeightFormHandler $formHandler,
        SaveWeightUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectTo($request,  'page_player_weights_for_current_user');
        }

        return $this->render('player/body-tracker/pages/weight-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/body-tracker/weights/{weightId}/edit', name: 'page_player_weight_edit', requirements: ['weightId' => '\d+'], methods: ['GET', 'POST'])]
    public function editWeight(
        Request $request,
        SaveWeightFormHandler $formHandler,
        SaveWeightUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectTo($request,  'page_player_weights_for_current_user');
        }

        return $this->render('player/body-tracker/pages/weight-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/me/body-tracker/weights/{weightId}/delete', name: 'page_player_weight_delete', requirements: ['weightId' => '\d+'], methods: ['GET'])]
    public function deleteWeight(
        int $weightId,
        Request $request,
        DeleteWeightUseCase $useCase
    ): Response {
        $useCase->execute($weightId);

        return $this->redirectTo($request,  'page_player_weights_for_current_user');
    }
}