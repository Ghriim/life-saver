<?php

namespace App\Infrastructure\Form\FormHandler\Player\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Provider\TheCoach\ExerciseDTOProviderGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\TheCoach\SaveExerciseFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveExerciseFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private ExerciseDTOProviderGateway $exerciseDTOProviderGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $exercise = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveExerciseFormType::class,
            $exercise,
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $exercise);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): ExerciseDTO
    {
        if (false === $request->attributes->has('exerciseId')) {
            $workout = $this->workoutDTOProviderGateway->getWorkoutById($request->attributes->get('workoutId'));
            if (null === $workout) {
                throw new NotFoundHttpException();
            }

            $exercise = new ExerciseDTO();
            $exercise->batchId = uniqid();
            $exercise->workout = $workout;

            return $exercise;
        }

        $exercise = $this->exerciseDTOProviderGateway->getExerciseById($request->attributes->get('exerciseId'));
        if (null === $exercise) {
            throw new NotFoundHttpException();
        }

        return $exercise;
    }
}