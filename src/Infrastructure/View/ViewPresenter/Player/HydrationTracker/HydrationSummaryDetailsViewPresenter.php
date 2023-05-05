<?php

namespace App\Infrastructure\View\ViewPresenter\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\PercentageViewFormatter;
use App\Infrastructure\View\ViewModel\Player\HydrationTracker\HydrationSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class HydrationSummaryDetailsViewPresenter implements ViewPresenterInterface
{
    public function present(HydrationSummaryDTO $DTO): HydrationSummaryDetailsViewModel
    {
        $model = new HydrationSummaryDetailsViewModel();
        $model->dailyGoal = $DTO->dailyGoal;
        $model->dailyProgress = $DTO->dailyProgress;
        $model->completion = PercentageViewFormatter::toStringFormat($DTO->dailyGoal, $DTO->dailyProgress);
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate, true);

        return $model;
    }
}