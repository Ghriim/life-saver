<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\PlayerExerciseInWorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractExerciseInWorkoutListPresenter;

final class PlayerExerciseInWorkoutListPresenter extends AbstractExerciseInWorkoutListPresenter
{
    public function present(ExerciseDTO $DTO): PlayerExerciseInWorkoutListViewModel
    {
        $model = new PlayerExerciseInWorkoutListViewModel();

        return $this->presentCommonFields($model, $DTO);
    }
}