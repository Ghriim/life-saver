<?php

namespace App\Infrastructure\View\ViewPresenter\Player\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\DurationViewFormatter;
use App\Infrastructure\View\ViewFormatter\WeightViewFormatter;
use App\Infrastructure\View\ViewModel\Player\BodyTracker\WeightListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class WeightListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param WeightDTO[] $DTOs
     *
     * @return WeightListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ( $DTOs as $DTO) {
            $model = new WeightListViewModel();
            $model->id = $DTO->id;
            $model->weight = WeightViewFormatter::toKGFormat($DTO->weight);
            $model->userId = $DTO->userId;

            $models[] = $model;
        }

        return $models;
    }
}