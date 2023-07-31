<?php

namespace App\Infrastructure\Controller\Admin\TheCoach;

use App\Infrastructure\Controller\Player\AbstractAdminController;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SaveEquipmentFormHandler;
use App\Infrastructure\Form\FormHandler\Admin\TheCoach\SearchEquipmentsFormHandler;
use App\UseCase\Admin\TheCoach\DeleteEquipmentUseCase;
use App\UseCase\Admin\TheCoach\GetEquipmentsUseCase;
use App\UseCase\Admin\TheCoach\SaveEquipmentUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EquipmentController extends AbstractAdminController
{
    #[Route('/the-coach/equipments', name: 'page_admin_equipments', methods: ['GET', 'POST'])]
    public function getEquipments(
        Request $request,
        SearchEquipmentsFormHandler $formHandler,
        GetEquipmentsUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);

        $searchParameters = null;
        if (true === $formHandler->isHandledSuccessfully()) {
            $searchParameters = $formHandler->getForm()->getData();
        }

        $equipments = $useCase->execute($searchParameters);

        return $this->render(
            'admin/the-coach/pages/equipment-list.html.twig',
            [
                'form' => $formHandler->getForm()->createView(),
                'equipments' => $equipments
            ]
        );
    }

    #[Route('/the-coach/equipments/add', name: 'page_admin_equipment_add', methods: ['GET', 'POST'])]
    public function addEquipment(
        Request $request,
        SaveEquipmentFormHandler $formHandler,
        SaveEquipmentUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentAdminId());

            return $this->redirectToRoute('page_admin_equipments');
        }

        return $this->render('admin/the-coach/pages/equipment-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/equipments/{equipmentId}/edit', name: 'page_admin_equipment_edit', requirements: ['equipmentId' => '\d+'], methods: ['GET', 'POST'])]
    public function editEquipment(
        Request $request,
        SaveEquipmentFormHandler $formHandler,
        SaveEquipmentUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentAdminId());

            return $this->redirectToRoute('page_admin_equipments');
        }

        return $this->render('admin/the-coach/pages/equipment-save.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/equipments/{equipmentId}/delete', name: 'page_admin_equipment_delete', requirements: ['equipmentId' => '\d+'], methods: ['GET'])]
    public function deleteEquipment(
        int $equipmentId,
        DeleteEquipmentUseCase $useCase
    ): Response {
        $useCase->execute($equipmentId);

        return $this->redirectToRoute('page_admin_equipments');
    }
}