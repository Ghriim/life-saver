<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\MovementDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MovementDetailsViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private EquipmentListViewPresenter $equipmentListPresenter,
    ) {

    }

    public function present(MovementDTO $DTO): MovementDetailsViewModel
    {
        $model = new MovementDetailsViewModel();
        $model->id = $DTO->id;
        $model->name = $DTO->name;
        $model->image = $DTO->image;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        $model->equipments = $this->equipmentListPresenter->present($DTO->getEquipments());

        return $model;
    }
}