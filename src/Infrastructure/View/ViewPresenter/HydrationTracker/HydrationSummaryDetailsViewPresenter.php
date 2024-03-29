<?php

namespace App\Infrastructure\View\ViewPresenter\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\PercentageViewFormatter;
use App\Infrastructure\View\ViewModel\HydrationTracker\HydrationIntakeInSummaryDetailsViewModel;
use App\Infrastructure\View\ViewModel\HydrationTracker\HydrationSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class HydrationSummaryDetailsViewPresenter implements ViewPresenterInterface
{
    public function present(HydrationSummaryDTO $DTO, ?array $intakes): HydrationSummaryDetailsViewModel
    {
        $model = new HydrationSummaryDetailsViewModel();
        $model->dailyGoal = $DTO->dailyGoal;
        $model->dailyProgress = $DTO->dailyProgress;
        $model->completion = PercentageViewFormatter::toStringFormat($DTO->dailyProgress, $DTO->dailyGoal);
        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate, true);
        $model->intakes = $this->computeIntakes($intakes ?? []);

        return $model;
    }

    /**
     * @param HydrationIntakeDTO[] $intakes
     *
     * @return HydrationIntakeInSummaryDetailsViewModel[]
     */
    private function computeIntakes(array $intakes): array
    {
        $models = [];
        foreach ($intakes as $intake) {
            $model = new HydrationIntakeInSummaryDetailsViewModel();
            $model->id = $intake->id;
            $model->volume = $intake->volume;
            $model->added = DateTimeViewFormatter::hourOfDateToString($intake->createDate, true);

            $models[] = $model;
        }

        return $models;
    }
}