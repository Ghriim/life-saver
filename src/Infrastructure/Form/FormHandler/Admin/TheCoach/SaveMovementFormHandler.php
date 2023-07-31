<?php

namespace App\Infrastructure\Form\FormHandler\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Admin\TheCoach\SaveMovementFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveMovementFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private MovementDTOProviderGateway $providerGateway,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $movement = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveMovementFormType::class,
            $movement
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $movement);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): MovementDTO
    {
        if (false === $request->attributes->has('movementId')) {
            return new MovementDTO();
        }

        $rmovement = $this->providerGateway->getMovementById($request->attributes->get('movementId'));
        if (null === $rmovement) {
            throw new NotFoundHttpException();
        }

        return $rmovement;
    }
}

