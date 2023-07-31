<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\MovementListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MovementListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param MovementDTO[] $DTOs
     *
     * @return MovementListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new MovementListViewModel();
            $model->id = $DTO->id;
            $model->name = $DTO->name;
            $model->iamge = $DTO->image;
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}