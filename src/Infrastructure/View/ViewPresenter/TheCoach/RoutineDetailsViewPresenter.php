<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\MovementInRoutineListViewModel;
use App\Infrastructure\View\ViewModel\TheCoach\RoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class RoutineDetailsViewPresenter implements ViewPresenterInterface
{
    public function __construct(
        private MovementInRoutineListPresenter $movementInRoutineListPresenter,
    ) {

    }

    public function present(RoutineDTO $DTO): RoutineDetailsViewModel
    {
        $model = new RoutineDetailsViewModel();

        $model->id = $DTO->id;
        $model->title = $DTO->title;
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        $model->movements = $this->presentMovements($DTO->getMovements());

        return $model;
    }

    /**
     * @param RoutineToMovementDTO[] $movements
     *
     * @return MovementInRoutineListViewModel[]
     */
    private function presentMovements(array $movements): array
    {
        $models = [];
        foreach ($movements as $movement) {
            $model = $this->movementInRoutineListPresenter->present($movement);
            $models[] = $model;
        }

        return $models;
    }
}
