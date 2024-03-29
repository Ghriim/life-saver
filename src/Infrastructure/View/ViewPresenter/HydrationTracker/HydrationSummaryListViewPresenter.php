<?php

namespace App\Infrastructure\View\ViewPresenter\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\PercentageViewFormatter;
use App\Infrastructure\View\ViewModel\HydrationTracker\HydrationSummaryListViewModel;
use App\Infrastructure\View\ViewModel\MindTracker\MoodListViewModel;
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
        foreach ($DTOs as $DTO) {
            $model = new HydrationSummaryListViewModel();
            $model->completion = PercentageViewFormatter::toStringFormat($DTO->dailyProgress, $DTO->dailyGoal);
            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate, true);

            $models[] = $model;
        }

        return $models;
    }
}