<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Infrastructure\View\ViewModel\Player\TheCoach\PlayerRoutineListViewModel;
use App\Infrastructure\View\ViewModel\Player\TheCoach\RoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractRoutineListViewPresenter;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class PlayerRoutineListViewPresenter extends AbstractRoutineListViewPresenter
{
    /**
     * @param RoutineDTO[] $DTOs
     *
     * @return PlayerRoutineListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new PlayerRoutineListViewModel();

            $models[] = $this->presentCommonFields($DTO, $model);
        }

        return $models;
    }
}