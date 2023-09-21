<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Infrastructure\View\ViewModel\TheCoach\ExerciseBatchInWorkoutDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class ExerciseBatchInWorkoutDetailsPresenter implements ViewPresenterInterface
{
    public function __construct(
        private ExerciseInWorkoutListPresenter $exerciseInWorkoutListPresenter
    ) {
    }

    /**
     * @param ExerciseBatchInWorkoutDetailsViewModel[]       $batches
     */
    public function present(array $batches, ExerciseDTO $DTO): ExerciseBatchInWorkoutDetailsViewModel
    {
        if (isset($batches[$DTO->batchId])) {
            $model = $batches[$DTO->batchId];
            $model->exercises[] = $this->exerciseInWorkoutListPresenter->present($DTO);

            return $model;
        }

        $model = new ExerciseBatchInWorkoutDetailsViewModel();

        $model->batchId = $DTO->batchId;
        $model->movementId = $DTO->movement->id;
        $model->movementName = $DTO->movement->name;

        $model->exercises[] = $this->exerciseInWorkoutListPresenter->present($DTO);

        return $model;
    }
}