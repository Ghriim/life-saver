<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\PlayerMovementInRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractMovementInRoutineListPresenter;

final class PlayerMovementInRoutineListPresenter extends AbstractMovementInRoutineListPresenter
{
    public function present(RoutineToMovementDTO $DTO): PlayerMovementInRoutineListViewModel
    {
        $model = new PlayerMovementInRoutineListViewModel();

        return $this->presentCommonFields($DTO, $model);
    }
}