<?php

namespace App\Infrastructure\View\ViewPresenter\Common\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Infrastructure\View\ViewModel\Common\TheCoach\AbstractExerciseInWorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

abstract class AbstractExerciseInWorkoutListPresenter implements ViewPresenterInterface
{
    public function presentCommonFields(AbstractExerciseInWorkoutListViewModel $model, ExerciseDTO $DTO): AbstractExerciseInWorkoutListViewModel
    {
        $model->id = $DTO->id;

        $model->movementId = $DTO->movement->id;
        $model->movementName = $DTO->movement->name;


        $model->targetReps = ($DTO->targetReps ?? 0).'reps';
        $model->targetWeight = ($DTO->targetWeight ?? 0).'Kg';

        $model->completedReps = ($DTO->completedReps ?? 0).'reps';
        $model->completedWeight = ($DTO->completedWeight ?? 0).'Kg';

        return $model;
    }
}