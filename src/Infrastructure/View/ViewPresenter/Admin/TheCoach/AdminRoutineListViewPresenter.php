<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractRoutineListViewPresenter;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class AdminRoutineListViewPresenter extends AbstractRoutineListViewPresenter
{
    /**
     * @param RoutineDTO[] $DTOs
     *
     * @return AdminRoutineListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new AdminRoutineListViewModel();

            $models[] = $this->presentCommonFields($DTO, $model);
        }

        return $models;
    }
}