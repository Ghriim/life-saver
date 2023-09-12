<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminMovementInRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractMovementInRoutineListPresenter;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class AdminMovementInRoutineListPresenter extends AbstractMovementInRoutineListPresenter
{
    public function present(RoutineToMovementDTO $DTO): AdminMovementInRoutineListViewModel
    {
        $model = new AdminMovementInRoutineListViewModel();

        return $this->presentCommonFields($DTO, $model);
    }
}