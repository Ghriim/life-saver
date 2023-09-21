<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\MovementListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MovementListViewPresenter implements ViewPresenterInterface
{
    PUBLIC function present(MovementDTO $DTO, MovementListViewModel $model): MovementListViewModel
    {
        $model->id = $DTO->id;
        $model->name = $DTO->name;
        $model->image = $DTO->image;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        return $model;
    }
}