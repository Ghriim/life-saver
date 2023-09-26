<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\TheCoach\SaveExerciseFormHandler;
use App\UseCase\Player\TheCoach\DeleteBatchOfExercisesUseCase;
use App\UseCase\Player\TheCoach\DeleteExerciseUseCase;
use App\UseCase\Player\TheCoach\DuplicateExerciseUseCase;
use App\UseCase\Player\TheCoach\SaveExerciseUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ExerciseController extends AbstractPlayerController
{
    #[Route('/the-coach/workouts/{workoutId}/exercises/add', name: 'page_player_exercise_add', requirements: ['workoutId' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/the-coach/workouts/{workoutId}/exercises/{exerciseId}/edit', name: 'page_player_exercise_edit', requirements: ['workoutId' => '\d+', 'exerciseId' => '\d+'], methods: ['GET', 'POST'])]
    public function saveExercise(
        int $workoutId,
        Request $request,
        SaveExerciseFormHandler $formHandler,
        SaveExerciseUseCase $useCase,
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectTo($request,  'page_player_workout_details', ['workoutId' => $workoutId]);
        }

        return $this->render(
            'player/the-coach/pages/exercise-save.html.twig',
            [
                'redirect' => $request->get('redirect'),
                'workoutId' => $workoutId,
                'form' => $formHandler->getForm()->createView()
            ]
        );
    }

    #[Route('/the-coach/workouts/{workoutId}/exercises/{exerciseId}/delete', name: 'page_player_exercise_delete', requirements: ['workoutId' => '\d+', 'exerciseId' => '\d+'], methods: ['POST'])]
    public function deleteExercise(
        int $workoutId,
        int $exerciseId,
        Request $request,
        DeleteExerciseUseCase $useCase
    ): Response {
        $useCase->execute($workoutId, $exerciseId, $this->getCurrentUserId());

        return $this->redirectTo($request,'page_player_workout_details', ['workoutId' => $workoutId]);
    }

    #[Route('/the-coach/workouts/{workoutId}/exercises/delete-batch/{batchId}', name: 'page_player_exercise_delete_batch', requirements: ['workoutId' => '\d+'], methods: ['DELETE'])]
    public function deleteBatchOfExercises(
        int $workoutId,
        string $batchId,
        Request $request,
        DeleteBatchOfExercisesUseCase $useCase
    ): Response {
        $useCase->execute($workoutId, $batchId, $this->getCurrentUserId());

        return $this->redirectTo($request,'page_player_workout_details', ['workoutId' => $workoutId]);
    }

    #[Route('/the-coach/workouts/{workoutId}/exercises/{exerciseId}/duplicate', name: 'page_player_exercise_duplicate', requirements: ['workoutId' => '\d+', 'exerciseId' => '\d+'], methods: ['GET'])]
    public function duplicateExercise(
        int $workoutId,
        int $exerciseId,
        Request $request,
        DuplicateExerciseUseCase $useCase
    ): Response {
        $useCase->execute($this->getCurrentUserId(), $workoutId, $exerciseId);

        return $this->redirectTo($request,'page_player_workout_details', ['workoutId' => $workoutId]);
    }
}