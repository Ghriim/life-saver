<?php

namespace App\Infrastructure\Form\FormHandler\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Admin\TheCoach\AddMovementToRoutineFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class AddMovementToRoutineFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
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
        return new RoutineToMovementDTO();
    }
}
