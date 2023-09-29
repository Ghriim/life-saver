<?php

namespace App\Infrastructure\View\ViewPresenter\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\DurationViewFormatter;
use App\Infrastructure\View\ViewModel\BodyTracker\SleepListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;
use DateInterval;
use DateTimeImmutable;
use DatePeriod;

final class SleepListViewPresenter implements ViewPresenterInterface
{
    /**
     * @param SleepDTO[] $DTOs
     *
     * @return SleepListViewModel[]
     */
    public function present(array $DTOs, ?DateTimeImmutable $startDate, ?DateTimeImmutable $endDate): array
    {
        $intervalToDisplay = $this->computeIntervalToDisplay($DTOs, $startDate, $endDate);

        foreach ($DTOs as $DTO) {
            $model = new SleepListViewModel();
            $model->id = $DTO->id;
            $model->inBed = DateTimeViewFormatter::toStringFormat($DTO->inBed);
            $model->outOfBed = DateTimeViewFormatter::toStringFormat($DTO->outOfBed);
            $model->duration = null !== $DTO->duration ? DurationViewFormatter::toHMFormat($DTO->duration) : null;

            $intervalToDisplay[$DTO->inBed->format('d-m-y')] = $model;
        }

        return $intervalToDisplay;
    }

    private function computeIntervalToDisplay(array $DTOs, ?DateTimeImmutable $startDate, ?DateTimeImmutable $endDate): array
    {
        if (null === $startDate && false === empty($DTOs)) {
            $startDate = end($DTOs)->inBed;
        }

        if (null === $endDate) {
            $endDate = new DateTimeImmutable();
        }

        $endDate = $endDate->setTime(0,0,1); // Ensure last day is included

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($startDate, $interval, $endDate);

        $intervalToDisplay = [];
        foreach ($period as $date) {
            $intervalToDisplay[$date->format('d-m-y')] = new SleepListViewModel(); // Placeholder
        }

        return $intervalToDisplay;
    }
}