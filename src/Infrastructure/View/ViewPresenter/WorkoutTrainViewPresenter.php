<?php

namespace App\Infrastructure\View\ViewPresenter;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutTrainViewModel;
use App\Infrastructure\View\ViewPresenter\TheCoach\WorkoutDetailsViewPresenter;

final class WorkoutTrainViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private WorkoutDetailsViewPresenter $workoutDetailsViewPresenter,
    ) {

    }

    public function present(WorkoutDTO $workoutDTO, ExerciseDTO $currentExercise): WorkoutTrainViewModel
    {
        $model = new WorkoutTrainViewModel();
        $model->workout = $this->workoutDetailsViewPresenter->present($workoutDTO);
        $model->currentBatchId = $currentExercise->batchId;
        $model->currentExerciseId = $currentExercise->id;

        return $model;
    }
}