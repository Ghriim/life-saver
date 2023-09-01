<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\RoutineListViewModel;
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

            $models[] = $model;
        }

        return $models;
    }
}