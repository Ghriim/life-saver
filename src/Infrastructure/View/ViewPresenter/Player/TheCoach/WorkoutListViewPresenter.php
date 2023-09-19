<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Player\TheCoach\WorkoutListViewModel;
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
            $model->completedDate = DateTimeViewFormatter::toStringFormat($DTO->completedDate);

            $models[] = $model;
        }

        return $models;
    }
}