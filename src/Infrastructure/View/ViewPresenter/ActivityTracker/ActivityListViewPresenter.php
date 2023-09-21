<?php

namespace App\Infrastructure\View\ViewPresenter\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\ActivityTracker\ActivityListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class ActivityListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param ActivityDTO[] $DTOs
     *
     * @return ActivityListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new ActivityListViewModel();
            $model->id = $DTO->id;
            $model->title = null === $DTO->activityType ? $DTO->title : $DTO->activityType->title;
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}