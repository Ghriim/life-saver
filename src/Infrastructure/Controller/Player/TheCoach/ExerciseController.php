<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\UseCase\Player\TheCoach\DeleteExerciseUseCase;
use App\UseCase\Player\TheCoach\DuplicateExerciseUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ExerciseController extends AbstractPlayerController
{
    #[Route('/the-coach/workouts/{workoutId}/exercises/{exerciseId}/delete', name: 'page_player_exercise_delete', methods: ['GET'])]
    public function deleteExercise(
        int $workoutId,
        int $exerciseId,
        Request $request,
        DeleteExerciseUseCase $useCase
    ): Response {
        $useCase->execute($this->getCurrentUserId(), $workoutId, $exerciseId);

        return $this->redirectTo($request,'page_player_workout_details', ['workoutId' => $workoutId]);
    }

    #[Route('/the-coach/workouts/{workoutId}/exercises/{exerciseId}/duplicate', name: 'page_player_exercise_duplicate', methods: ['GET'])]
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