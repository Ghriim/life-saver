<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\PlayerMovementInRoutineListViewModel;
use App\Infrastructure\View\ViewModel\Player\TheCoach\PlayerRoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractRoutineDetailsViewPresenter;

final class PlayerRoutineDetailsViewPresenter extends AbstractRoutineDetailsViewPresenter
{
    public function __construct(
        private PlayerMovementInRoutineListPresenter $movementListPresenter
    ) {
    }

    public function present(RoutineDTO $DTO): PlayerRoutineDetailsViewModel
    {
        $model = new PlayerRoutineDetailsViewModel();

        $model =  $this->presentCommonFields($DTO, $model);
        $model->movements = $this->presentMovements($DTO->getMovements());

        return $model;
    }

    /**
     * @param RoutineToMovementDTO[] $movements
     *
     * @return PlayerMovementInRoutineListViewModel[]
     */
    private function presentMovements(array $movements): array
    {
        $models = [];
        foreach ($movements as $movement) {
            $models[] = $this->movementListPresenter->present($movement);
        }

        return $models;
    }
}