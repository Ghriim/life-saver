<?php

namespace App\Infrastructure\View\ViewPresenter\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\PercentageViewFormatter;
use App\Infrastructure\View\ViewModel\Player\HydrationTracker\HydrationSummaryListViewModel;
use App\Infrastructure\View\ViewModel\Player\MindTracker\MoodListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class HydrationSummaryListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param HydrationSummaryDTO[] $DTOs
     *
     * @return MoodListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ( $DTOs as $DTO) {
            $model = new HydrationSummaryListViewModel();
            $model->id = $DTO->id;
            $model->dailyGoal = $DTO->dailyGoal;
            $model->dailyProgress = $DTO->dailyProgress;
            $model->completion = PercentageViewFormatter::toStringFormat($DTO->dailyGoal, $DTO->dailyProgress);
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}