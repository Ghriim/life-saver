<?php

namespace App\Infrastructure\Form\FormHandler\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Admin\TheCoach\SaveRoutineFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveRoutineFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private RoutineDTOProviderGateway $providerGateway,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $routine = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveRoutineFormType::class,
            $routine
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $routine);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): RoutineDTO
    {
        if (false === $request->attributes->has('routineId')) {
            return new RoutineDTO();
        }

        $rroutine = $this->providerGateway->getRoutineById($request->attributes->get('routineId'));
        if (null === $rroutine) {
            throw new NotFoundHttpException();
        }

        return $rroutine;
    }
}

