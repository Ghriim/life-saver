<?php

namespace App\Infrastructure\Form\FormHandler\Admin\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Domain\Gateway\Provider\TheCoach\EquipmentDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Admin\TheCoach\SaveEquipmentFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveEquipmentFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private EquipmentDTOProviderGateway $providerGateway,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $equipment = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveEquipmentFormType::class,
            $equipment
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $equipment);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): EquipmentDTO
    {
        if (false === $request->attributes->has('equipmentId')) {
            return new EquipmentDTO();
        }

        $requipment = $this->providerGateway->getEquipmentById($request->attributes->get('equipmentId'));
        if (null === $requipment) {
            throw new NotFoundHttpException();
        }

        return $requipment;
    }
}

