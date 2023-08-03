<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\RoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class RoutineListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param RoutineDTO[] $DTOs
     *
     * @return RoutineListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new RoutineListViewModel();
            $model->id = $DTO->id;
            $model->title = $DTO->title;
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}