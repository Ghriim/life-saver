<?php

namespace App\Infrastructure\Controller\Admin\TheCoach;

use App\Infrastructure\Controller\Player\AbstractAdminController;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\AddEquipmentToMovementFormHandler;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SaveMovementFormHandler;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SearchMovementsFormHandler;
use App\UseCase\Admin\TheCoach\AddEquipmentToMovementUseCase;
use App\UseCase\Admin\TheCoach\DeleteMovementUseCase;
use App\UseCase\Admin\TheCoach\GetMovementsUseCase;
use App\UseCase\Admin\TheCoach\GetMovementUseCase;
use App\UseCase\Admin\TheCoach\DeleteEquipmentFromMovementUseCase;
use App\UseCase\Admin\TheCoach\SaveMovementUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MovementController extends AbstractAdminController
{
    #[Route('/the-coach/movements', name: 'page_admin_movements', methods: ['GET', 'POST'])]
    public function getMovements(
        Request $request,
        SearchMovementsFormHandler $formHandler,
        GetMovementsUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);

        $searchParameters = null;
        if (true === $formHandler->isHandledSuccessfully()) {
            $searchParameters = $formHandler->getForm()->getData();
        }

        $movements = $useCase->execute($searchParameters);

        return $this->render(
            'admin/the-coach/pages/movement-list.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
                'movements' => $movements
            ]
        );
    }

    #[Route('/the-coach/movements/{movementId}', name: 'page_admin_movement_details', requirements: ['movementId' => '\d+'], methods: ['GET'])]
    public function getMovement(
        int $movementId,
        GetMovementUseCase $useCase
    ): Response {
        return $this->render(
            'admin/the-coach/pages/movement-details.html.twig',
            [
                'movement' => $useCase->execute($movementId)
            ]
        );
    }

    #[Route('/the-coach/movements/add', name: 'page_admin_movement_add', methods: ['GET', 'POST'])]
    #[Route('/the-coach/movements/{movementId}/edit', name: 'page_admin_movement_edit', requirements: ['movementId' => '\d+'], methods: ['GET', 'POST'])]
    public function editMovement(
        Request $request,
        SaveMovementFormHandler $formHandler,
        SaveMovementUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $movement = $useCase->execute($formHandler->getDto(), $this->getCurrentAdminId());

            return $this->redirectTo($request,  'page_admin_movement_details', ['movementId' => $movement->id]);
        }

        return $this->render('admin/the-coach/pages/movement-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/movements/{movementId}/delete', name: 'page_admin_movement_delete', requirements: ['movementId' => '\d+'], methods: ['GET'])]
    public function deleteMovement(
        int $movementId,
        Request $request,
        DeleteMovementUseCase $useCase
    ): Response {
        $useCase->execute($movementId);

        return $this->redirectTo($request,  'page_admin_movements');
    }

    #[Route('/the-coach/movements/{movementId}/add-equipment', name: 'page_admin_movement_add_equipment', requirements: ['movementId' => '\d+'], methods: ['GET', 'POST'])]
    public function addEquipment(
        int $movementId,
        Request $request,
        AddEquipmentToMovementFormHandler $formHandler,
        AddEquipmentToMovementUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($movementId, $formHandler->getForm()->getData());

            return $this->redirectTo($request,  'page_admin_movement_details', ['movementId' => $movementId]);
        }

        return $this->render(
            'admin/the-coach/pages/movement-add-equipment.html.twig',
            [
                'movementId' => $movementId,
                'form' => $formHandler->getForm()->createView(),
            ]
        );
    }

    #[Route('/the-coach/movements/{movementId}/delete-equipment/{equipmentId}', name: 'page_admin_movement_delete_equipment', requirements: ['movementId' => '\d+', 'equipmentId' => '\d+'], methods: ['GET'])]
    public function deleteEquipment(
        int $movementId,
        int $equipmentId,
        Request $request,
        DeleteEquipmentFromMovementUseCase $useCase
    ): Response {
        $useCase->execute($movementId, $equipmentId);

        return $this->redirectTo($request,  'page_admin_movement_details', ['movementId' => $movementId]);
    }
}