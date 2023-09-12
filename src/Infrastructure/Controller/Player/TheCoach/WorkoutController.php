<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\TheCoach\PlanWorkoutFormHandler;
use App\UseCase\Player\TheCoach\PlanWorkoutFromRoutineUseCase;
use App\UseCase\Player\TheCoach\GetWorkoutUseCase;
use App\UseCase\Player\TheCoach\StartWorkoutFromRoutineUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WorkoutController extends AbstractPlayerController
{
    #[Route('/the-coach/workouts/{workoutId}', name: 'page_player_workout_details', requirements: ['workoutId' => '\d+'], methods: ['GET', 'POST'])]
    public function getWorkout(
        int $workoutId,
        GetWorkoutUseCase $useCase
    ): Response {
        return $this->render(
            'player/the-coach/pages/workout-details.html.twig',
               ['workout' => $useCase->execute($workoutId)]
        );
    }

    #[Route('/the-coach/workouts/plan/{routineId}', name: 'page_player_workout_plan_from_routine', requirements: ['routineId' => '\d+'], methods: ['GET', 'POST'])]
    public function planWorkoutFromRoutine(
        Request $request,
        PlanWorkoutFormHandler $formHandler,
        PlanWorkoutFromRoutineUseCase $useCase
    ): Response {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $workout = $useCase->execute($formHandler->getDto(), $this->getCurrentUserId());

            return $this->redirectToRoute('page_player_workout_details', ['workoutId' => $workout->id]);
        }

        return $this->render('player/the-coach/pages/workout-plan.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/workouts/start/{routineId}', name: 'page_player_workout_start_from_routine', requirements: ['routineId' => '\d+'], methods: ['POST'])]
    public function startWorkoutFromRoutine(
        int $routineId,
        StartWorkoutFromRoutineUseCase $useCase
    ): Response {
        $workout = $useCase->execute($routineId, $this->getCurrentUserId());

        return $this->redirectToRoute('page_player_workout_details', ['workoutId' => $workout->id]);
    }

    #[Route('/the-coach/workouts/{workoutId}/complete', name: 'page_player_workout_start', requirements: ['workoutId' => '\d+'], methods: ['POST'])]
    public function completeWorkout(Request $request): Response
    {
    }

    #[Route('/the-coach/workouts/{workoutId}/delete', name: 'page_player_workout_start',  requirements: ['workoutId' => '\d+'], methods: ['GET', 'POST'])]
    public function deleteWorkout(int $workoutId): Response
    {
    }
}