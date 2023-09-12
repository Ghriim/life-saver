<?php

namespace App\Infrastructure\View\ViewPresenter\Common\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Common\TheCoach\AbstractMovementListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

abstract class AbstractMovementListViewPresenter implements ViewPresenterInterface
{
    protected function presentCommonFields(MovementDTO $DTO, AbstractMovementListViewModel $model): AbstractMovementListViewModel
    {
        $model->id = $DTO->id;
        $model->name = $DTO->name;
        $model->image = $DTO->image;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        return $model;
    }
}