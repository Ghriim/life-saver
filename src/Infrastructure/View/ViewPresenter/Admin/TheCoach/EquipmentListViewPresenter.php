<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\EquipmentListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class EquipmentListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param EquipmentDTO[] $DTOs
     *
     * @return EquipmentListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new EquipmentListViewModel();
            $model->id = $DTO->id;
            $model->name = $DTO->name;
            $model->icon = $DTO->icon;
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}