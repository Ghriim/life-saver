<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\ExerciseBatchInWorkoutDetailsViewModel;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WorkoutDetailsViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private ExerciseBatchInWorkoutDetailsPresenter $batchExercisesPresenter,
    ) {

    }

    public function present(WorkoutDTO $DTO): WorkoutDetailsViewModel
    {
        $model = new WorkoutDetailsViewModel();
        $model->id = $DTO->id;
        $model->title = $DTO->title;
        $model->status = $DTO->status;

        $model->plannedDate = DateTimeViewFormatter::toStringFormat($DTO->plannedDate);
        $model->startedDate = DateTimeViewFormatter::toStringFormat($DTO->startedDate);
        $model->completedDate = DateTimeViewFormatter::toStringFormat($DTO->completedDate);

        if (null !== $DTO->routine) {
            $model->routineId = $DTO->routine->id;
            $model->routineTitle = $DTO->routine->title;
        }

        $model->batches = $this->presentBatches($DTO->getExercises());

        return $model;
    }

    /**
     * @param ExerciseDTO[] $exercises
     *
     * @return ExerciseBatchInWorkoutDetailsViewModel[]
     */
    private function presentBatches(array $exercises): array
    {
        $models = [];
        foreach ($exercises as $exercise) {
            $model = $this->batchExercisesPresenter->present($models, $exercise);
            $models[$model->batchId] = $model;
        }

        return $models;
    }
}