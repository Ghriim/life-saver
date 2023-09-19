<?php

namespace App\Infrastructure\Controller\Admin\TheCoach;

use App\Infrastructure\Controller\Player\AbstractAdminController;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\AddMovementToRoutineFormHandler;
use App\UseCase\Admin\TheCoach\AddMovementToRoutineUseCase;
use App\UseCase\Admin\TheCoach\DeleteMovementFromRoutineUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RoutineToMovementController extends AbstractAdminController
{
    #[Route('/the-coach/routines/{routineId}/add-movement', name: 'page_admin_routine_add_movement', requirements: ['routineId' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/the-coach/routines/{routineId}/edit-movement/{routineToMovementId}', name: 'page_admin_routine_edit_movement', requirements: ['routineId' => '\d+', 'routineToMovementId' => '\d+'], methods: ['GET', 'POST'])]
    public function saveMovement(
        int $routineId,
        Request $request,
        AddMovementToRoutineFormHandler $formHandler,
        AddMovementToRoutineUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($routineId, $formHandler->getDTO());

            return $this->redirectTo($request,  'page_admin_routine_details', ['routineId' => $routineId]);
        }

        return $this->render(
            'admin/the-coach/pages/routine-add-movement.html.twig',
            [
                'routineId' => $routineId,
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    #[Route('/the-coach/routines/{routineId}/delete-movement/{routineToMovementId}', name: 'page_admin_routine_remove_movement', requirements: ['routineId' => '\d+', 'routineToMovementId' => '\d+'], methods: ['GET'])]
    public function deleteMovement(
        int $routineId,
        int $routineToMovementId,
        Request $request,
        DeleteMovementFromRoutineUseCase $useCase
    ): Response {
        $useCase->execute($routineToMovementId);

        return $this->redirectTo($request,  'page_admin_routine_details', ['routineId' => $routineId]);
    }
}