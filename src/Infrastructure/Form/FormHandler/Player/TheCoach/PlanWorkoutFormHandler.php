<?php

namespace App\Infrastructure\Form\FormHandler\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Infrastructure\Factory\DTOFactory\TheCoach\WorkoutDTOFactory;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\TheCoach\PlanWorkoutFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PlanWorkoutFormHandler implements FormHandlerInterface
{
    public function __construct(
        private RoutineDTOProviderGateway $routineDTOProviderGateway,
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private FormFactoryInterface $formFactory,
        private WorkoutDTOFactory $factory,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $workout = $this->provideDTO($request);
        $form = $this->formFactory->create(
            PlanWorkoutFormType::class,
            $workout,
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $workout);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): WorkoutDTO
    {
        if (false === $request->attributes->has('workoutId')) {
            $routine = $this->routineDTOProviderGateway->getRoutineById($request->attributes->get('routineId'));
            if (null === $routine) {
                throw new NotFoundHttpException();
            }

            return $this->factory->buildFromRoutine($routine);
        }

        $workout = $this->workoutDTOProviderGateway->getWorkoutById($request->attributes->get('workoutId'));
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        return $workout;
    }
}