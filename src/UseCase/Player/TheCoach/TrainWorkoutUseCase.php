<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Persister\TheCoach\WorkoutDTOPersisterGateway;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutTrainViewModel;
use App\Infrastructure\View\ViewPresenter\WorkoutTrainViewPresenter;
use App\UseCase\Player\TheCoach\Traits\FetchWorkoutForAlterationTrait;
use App\UseCase\UseCaseInterface;

final class TrainWorkoutUseCase implements UseCaseInterface
{
    use FetchWorkoutForAlterationTrait;

    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private WorkoutDTOPersisterGateway $workoutDTOPersisterGateway,
        private WorkoutTrainViewPresenter $workoutTrainViewPresenter,
    ) {
    }

    public function execute(int $workoutId, int $userId): WorkoutTrainViewModel
    {
        $workout = $this->fetchWorkout($workoutId, $userId);

        $currentExercise = true === empty($workout->getExercises()) ?: $workout->getExercises()[0];
        foreach ($workout->getExercises() as $exercise) {
            if (false === $exercise->isCompleted) {
                $currentExercise = $exercise;
                break;
            }
        }

        return $this->workoutTrainViewPresenter->present($workout, $currentExercise);
    }
}