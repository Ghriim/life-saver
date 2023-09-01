<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\WorkoutDetailsViewModel;
use App\Infrastructure\View\ViewModel\Player\TheCoach\WorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WorkoutDetailsViewPresenter implements ViewPresenterInterface
{
    public function present(WorkoutDTO $DTO): WorkoutDetailsViewModel
    {
        $model = new WorkoutDetailsViewModel();
        $model->id = $DTO->id;
        $model->title = $DTO->title;

        if (null !== $DTO->routine) {
            $model->routineId = $DTO->routine->id;
            $model->routineTitle = $DTO->routine->title;
        }

        return $model;
    }
}