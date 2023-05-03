<?php

namespace App\Infrastructure\View\ViewPresenter\Player\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Player\MindTracker\MoodListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MoodListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param MoodDTO[] $DTOs
     *
     * @return MoodListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ( $DTOs as $DTO) {
            $model = new MoodListViewModel();
            $model->id = $DTO->id;
            $model->level = $DTO->level;
            $model->description = $DTO->description;
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}