<?php

namespace App\Infrastructure\Controller\Admin\TheCoach;

use App\Infrastructure\Controller\Player\AbstractAdminController;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SaveRoutineFormHandler;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SearchRoutinesFormHandler;
use App\UseCase\Admin\TheCoach\DeleteRoutineUseCase;
use App\UseCase\Admin\TheCoach\GetRoutinesUseCase;
use App\UseCase\Admin\TheCoach\GetRoutineUseCase;
use App\UseCase\Admin\TheCoach\SaveRoutineUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RoutineController extends AbstractAdminController
{
    #[Route('/the-coach/routines', name: 'page_admin_routines', methods: ['GET', 'POST'])]
    public function getRoutines(
        Request $request,
        SearchRoutinesFormHandler $formHandler,
        GetRoutinesUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);

        $searchParameters = null;
        if (true === $formHandler->isHandledSuccessfully()) {
            $searchParameters = $formHandler->getForm()->getData();
        }

        $routines = $useCase->execute($searchParameters);

        return $this->render(
            'admin/the-coach/pages/routine-list.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
                'routines' => $routines
            ]
        );
    }

    #[Route('/the-coach/routines/{routineId}', name: 'page_admin_routine_details', requirements: ['routineId' => '\d+'], methods: ['GET'])]
    public function getRoutine(
        int $routineId,
        GetRoutineUseCase $useCase
    ): Response {
        return $this->render(
            'admin/the-coach/pages/routine-details.html.twig',
            [
                'routine' => $useCase->execute($routineId)
            ]
        );
    }

    #[Route('/the-coach/routines/add', name: 'page_admin_routine_add', methods: ['GET', 'POST'])]
    #[Route('/the-coach/routines/{routineId}/edit', name: 'page_admin_routine_edit', requirements: ['routineId' => '\d+'], methods: ['GET', 'POST'])]
    public function saveRoutine(
        Request $request,
        SaveRoutineFormHandler $formHandler,
        SaveRoutineUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $routine = $useCase->execute($formHandler->getDto(), $this->getCurrentAdminId());

            return $this->redirectTo($request,  'page_admin_routine_details', ['routineId' => $routine->id]);
        }

        return $this->render('admin/the-coach/pages/routine-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/routines/{routineId}/delete', name: 'page_admin_routine_delete', requirements: ['routineId' => '\d+'], methods: ['GET'])]
    public function deleteRoutine(
        int $routineId,
        DeleteRoutineUseCase $useCase
    ): Response {
        $useCase->execute($routineId);

        return $this->redirectTo($request,  'page_admin_routines');
    }
}