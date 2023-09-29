<?php

namespace App\Infrastructure\View\ViewPresenter\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Infrastructure\View\ViewModel\MindTracker\MoodDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MoodDetailsViewPresenter implements ViewPresenterInterface
{
    public function present(MoodDTO $DTO): MoodDetailsViewModel
    {
        $model = new MoodDetailsViewModel();
        $model->id = $DTO->id;
        $model->level = $DTO->level;
        $model->description = $DTO->description;

        return $model;
    }
}