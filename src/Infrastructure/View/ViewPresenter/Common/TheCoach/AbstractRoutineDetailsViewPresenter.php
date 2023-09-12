<?php

namespace App\Infrastructure\View\ViewPresenter\Common\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Common\TheCoach\AbstractRoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

abstract class AbstractRoutineDetailsViewPresenter implements ViewPresenterInterface
{
    protected function presentCommonFields(RoutineDTO $DTO, AbstractRoutineDetailsViewModel $model): AbstractRoutineDetailsViewModel
    {
        $model->id = $DTO->id;
        $model->title = $DTO->title;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        return $model;
    }
}
