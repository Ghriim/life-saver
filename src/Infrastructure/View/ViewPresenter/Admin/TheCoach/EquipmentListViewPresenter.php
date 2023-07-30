<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
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
            $model->name = $DTO->name;
            $model->icon = $DTO->icon;

            $models[] = $model;
        }

        return $models;
    }
}