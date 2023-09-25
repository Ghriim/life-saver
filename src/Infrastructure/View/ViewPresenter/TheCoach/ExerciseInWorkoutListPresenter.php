<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Infrastructure\View\ViewFormatter\WeightViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\ExerciseInWorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class ExerciseInWorkoutListPresenter implements ViewPresenterInterface
{
    public function present(ExerciseDTO $DTO): ExerciseInWorkoutListViewModel
    {
        $model = new ExerciseInWorkoutListViewModel();

        $model->id = $DTO->id;

        $model->movementId = $DTO->movement->id;
        $model->movementName = $DTO->movement->name;

        $model->setType = $DTO->setType;
        $model->restDuration = ($DTO->restDuration ?? 0).'sec';
        $model->batchId = $DTO->batchId;

        $model->targetReps = ($DTO->targetReps ?? 0).'reps';
        $model->targetWeight = WeightViewFormatter::toKGStringFormat($DTO->targetWeight);

        $model->completedReps = ($DTO->completedReps ?? 0).'reps';
        $model->completedWeight = WeightViewFormatter::toKGStringFormat($DTO->completedWeight);

        $model->isCompleted = $DTO->isCompleted;

        return $model;
    }
}