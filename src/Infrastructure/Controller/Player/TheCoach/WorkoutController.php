<?php

namespace App\Infrastructure\Controller\Player\TheCoach;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\TheCoach\PlanWorkoutFormHandler;
use App\UseCase\Player\TheCoach\CompleteWorkoutUseCase;
use App\UseCase\Player\TheCoach\DeleteWorkoutUseCase;
use App\UseCase\Player\TheCoach\GetWorkoutsForUserUseCase;
use App\UseCase\Player\TheCoach\PlanWorkoutFromRoutineUseCase;
use App\UseCase\Player\TheCoach\GetWorkoutUseCase;
use App\UseCase\Player\TheCoach\StartWorkoutFromRoutineUseCase;
use App\UseCase\Player\TheCoach\StartWorkoutUseCase;
use App\UseCase\Player\TheCoach\TrainWorkoutUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WorkoutController extends AbstractPlayerController
{
    #[Route('/the-coach/workouts/{workoutId}', name: 'page_player_workout_details', requirements: ['workoutId' => '\d+'], methods: ['GET'])]
    public function getWorkout(
        int $workoutId,
        GetWorkoutUseCase $useCase,
    ): Response {
        return $this->render(
            'player/the-coach/pages/workout-details.html.twig',
               ['workout' => $useCase->execute($workoutId)]
        );
    }

    #[Route('/me/the-coach/workouts/history', name: 'page_player_workouts_history', methods: ['GET'])]
    public function historyWorkouts(
        Request $request,
        GetWorkoutsForUserUseCase $useCase
    ): Response {
        $date = $request->query->get('date');

        $workouts = $useCase->execute(
            $this->getCurrentUserId(),
            GetWorkoutsForUserUseCase::CONTEXT_HISTORY,
            $date,
        );

        return $this->render(
            'player/the-coach/pages/workouts-history.html.twig',
            ['workouts' => $workouts]
        );
    }

    #[Route('/me/the-coach/workouts/planned', name: 'page_player_workouts_planned', methods: ['GET'])]
    public function plannedWorkouts(
        Request $request,
        GetWorkoutsForUserUseCase $useCase
    ): Response {
        $date = $request->query->get('date');

        $workouts = $useCase->execute(
            $this->getCurrentUserId(),
            GetWorkoutsForUserUseCase::CONTEXT_PLANNED,
            $date
        );

        return $this->render(
            'player/the-coach/pages/workouts-planned.html.twig',
            ['workouts' => $workouts]
        );
    }

    #[Route('/the-coach/workouts/{workoutId}/start', name: 'page_player_workout_start', requirements: ['workoutId' => '\d+'], methods: ['POST'])]
    public function startWorkout(
        int $workoutId,
        Request $request,
        StartWorkoutUseCase $useCase,
    ): Response {
        $useCase->execute($workoutId, $this->getCurrentUserId());

        return $this->redirectTo($request,  'page_player_workout_train', ['workoutId' => $workoutId]);
    }

    #[Route('/the-coach/workouts/{workoutId}/train', name: 'page_player_workout_train', requirements: ['workoutId' => '\d+'], methods: ['GET'])]
    public function trainWorkout(
        int $workoutId,
        TrainWorkoutUseCase $useCase,
    ): Response {
        $model = $useCase->execute($workoutId, $this->getCurrentUserId());

        return $this->render(
            'player/the-coach/pages/workout-train.html.twig',
            [
                'workout' => $model->workout,
                'currentBatchId' => $model->currentBatchId,
                'currentExerciseId' => $model->currentExerciseId
            ]
        );
    }

    #[Route('/the-coach/workouts/{workoutId}/complete', name: 'page_player_workout_complete', requirements: ['workoutId' => '\d+'], methods: ['POST'])]
    public function completeWorkout(
        int $workoutId,
        Request $request,
        CompleteWorkoutUseCase $useCase,
    ): Response {
        $useCase->execute($workoutId, $this->getCurrentUserId());

        return $this->redirectTo($request,'page_player_workout_details', ['workoutId' => $workoutId]);
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

            return $this->redirectTo($request,  'page_player_workout_details', ['workoutId' => $workout->id]);
        }

        return $this->render('player/the-coach/pages/workout-plan.html.twig', ['form' => $formHandler->getForm()->createView()]);
    }

    #[Route('/the-coach/workouts/start/{routineId}', name: 'page_player_workout_start_from_routine', requirements: ['routineId' => '\d+'], methods: ['POST'])]
    public function startWorkoutFromRoutine(
        int $routineId,
        Request $request,
        StartWorkoutFromRoutineUseCase $useCase
    ): Response {
        $workout = $useCase->execute($routineId, $this->getCurrentUserId());

        return $this->redirectTo($request,  'page_player_workout_details', ['workoutId' => $workout->id]);
    }

    #[Route('/the-coach/workouts/{workoutId}/delete', name: 'page_player_workout_delete',  requirements: ['workoutId' => '\d+'], methods: ['POST'])]
    public function deleteWorkout(
        int $workoutId,
        Request $request,
        DeleteWorkoutUseCase $useCase): Response
    {
        $useCase->execute($workoutId, $this->getCurrentUserId());

        return $this->redirectTo($request,'page_player_workout_plan_from_routine');
    }
}