<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Player\TheCoach\WorkoutDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WorkoutDetailsViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private PlayerExerciseInWorkoutListPresenter $exerciseInWorkoutListPresenter,
    ) {

    }

    public function present(WorkoutDTO $DTO): WorkoutDetailsViewModel
    {
        $model = new WorkoutDetailsViewModel();
        $model->id = $DTO->id;
        $model->title = $DTO->title;

        $model->plannedDate = DateTimeViewFormatter::toStringFormat($DTO->plannedDate);
        $model->startedDate = DateTimeViewFormatter::toStringFormat($DTO->startedDate);
        $model->completedDate = DateTimeViewFormatter::toStringFormat($DTO->completedDate);

        if (null !== $DTO->routine) {
            $model->routineId = $DTO->routine->id;
            $model->routineTitle = $DTO->routine->title;
        }

        $model->exercises = $this->presentExercises($DTO->getExercises());

        return $model;
    }

    /**
     * @param ExerciseDTO[] $exercises
     *
     * @return array
     */
    private function presentExercises(array $exercises): array
    {
        $models = [];
        foreach ($exercises as $exercise) {
            $models[] = $this->exerciseInWorkoutListPresenter->present($exercise);
        }

        return $models;
    }
}