<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminMovementInRoutineListViewModel;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminRoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractRoutineDetailsViewPresenter;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class AdminRoutineDetailsViewPresenter extends AbstractRoutineDetailsViewPresenter
{
    public function __construct(
        private AdminMovementInRoutineListPresenter $movementListPresenter,
    ) {
    }

    public function present(RoutineDTO $DTO): AdminRoutineDetailsViewModel
    {
        $model = new AdminRoutineDetailsViewModel();

        $model = $this->presentCommonFields($DTO, $model);
        $model->movements = $this->presentMovements($DTO->getMovements());

        return $model;
    }

    /**
     * @param RoutineToMovementDTO[] $movements
     *
     * @return AdminMovementInRoutineListViewModel[]
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