<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminMovementListViewModel;
use App\Infrastructure\View\ViewPresenter\Common\TheCoach\AbstractMovementListViewPresenter;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class AdminMovementListViewPresenter extends AbstractMovementListViewPresenter
{
    /**
     * @param MovementDTO[] $DTOs
     *
     * @return AdminMovementListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new AdminMovementListViewModel();

            $models[] = $this->presentCommonFields($DTO, $model);
        }

        return $models;
    }
}