<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WorkoutListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param WorkoutDTO[] $DTOs
     *
     * @return WorkoutListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new WorkoutListViewModel();
            $model->id = $DTO->id;
            $model->title = $DTO->title;
            $model->status = $DTO->status;
            $model->plannedDate = DateTimeViewFormatter::toStringFormat($DTO->plannedDate);
            $model->completedDate = DateTimeViewFormatter::toStringFormat($DTO->completedDate);

            $models[] = $model;
        }

        return $models;
    }
}