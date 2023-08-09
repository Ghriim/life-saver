<?php

namespace App\Infrastructure\Form\FormHandler\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\Gateway\Provider\TheCoach\RoutineToMovementDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Admin\TheCoach\AddMovementToRoutineFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class AddMovementToRoutineFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private RoutineToMovementDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $routineToMovement = $this->provideDTO($request);
        $form = $this->formFactory->create(
            AddMovementToRoutineFormType::class,
            $routineToMovement
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $routineToMovement);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): RoutineToMovementDTO
    {
        if (false === $request->attributes->has('routineToMovementId')) {
            return new RoutineToMovementDTO();
        }

        $routineToMovement = $this->providerGateway->getRoutineToMovementById($request->attributes->get('routineToMovementId'));
        if (null === $routineToMovement) {
            throw new NotFoundHttpException();
        }

        return $routineToMovement;
    }
}
