<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WorkoutListViewPresenter implements ViewPresenterInterface
{
    public const WORKOUTS_GROUP_BY_HOUR = 'hour';
    public const WORKOUTS_GROUP_BY_DAY = 'day';

    /**
     * @param WorkoutDTO[] $DTOs
     *
     * @return WorkoutListViewModel[]
     */
    public function present(array $DTOs, ?string $groupBy = null): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new WorkoutListViewModel();
            $model->id = $DTO->id;
            $model->title = $DTO->title;
            $model->status = $DTO->status;
            $model->plannedDate = DateTimeViewFormatter::toStringFormat($DTO->plannedDate);
            $model->completedDate = DateTimeViewFormatter::toStringFormat($DTO->completedDate);

            $models[$this->computeGroupKey($DTO, $groupBy)][] = $model;
        }

        return $models;
    }

    private function computeGroupKey(WorkoutDTO $DTO, ?string $groupBy): string
    {
        if (self::WORKOUTS_GROUP_BY_HOUR === $groupBy) {
            return $DTO->plannedDate->format('H');
        }

        if (self::WORKOUTS_GROUP_BY_DAY === $groupBy) {
            return $DTO->plannedDate->format('d');
        }

        return 'all';
    }
}