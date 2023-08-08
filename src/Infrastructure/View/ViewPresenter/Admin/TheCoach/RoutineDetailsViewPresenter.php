<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\RoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class RoutineDetailsViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private MovementInRoutineListPresenter $movementListPresenter,
    ) {

    }

    public function present(RoutineDTO $DTO): RoutineDetailsViewModel
    {
        $model = new RoutineDetailsViewModel();
        $model->id = $DTO->id;
        $model->title = $DTO->title;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        $model->movements = $this->movementListPresenter->present($DTO->getMovements());

        return $model;
    }
}