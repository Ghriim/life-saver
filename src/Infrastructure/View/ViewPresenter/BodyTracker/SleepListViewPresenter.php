<?php

namespace App\Infrastructure\View\ViewPresenter\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\DurationViewFormatter;
use App\Infrastructure\View\ViewModel\BodyTracker\SleepListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class SleepListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param SleepDTO[] $DTOs
     *
     * @return SleepListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ( $DTOs as $DTO) {
            $model = new SleepListViewModel();
            $model->id = $DTO->id;
            $model->inBed = DateTimeViewFormatter::toStringFormat($DTO->inBed);
            $model->outOfBed = DateTimeViewFormatter::toStringFormat($DTO->outOfBed);
            $model->duration = null !== $DTO->duration ? DurationViewFormatter::toHMFormat($DTO->duration) : null;

            $models[] = $model;
        }

        return $models;
    }
}