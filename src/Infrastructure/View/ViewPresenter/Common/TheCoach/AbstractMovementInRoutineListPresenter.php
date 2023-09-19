<?php

namespace App\Infrastructure\View\ViewPresenter\Common\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Common\TheCoach\AbstractMovementInRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

abstract class AbstractMovementInRoutineListPresenter implements ViewPresenterInterface
{
    protected function presentCommonFields(RoutineToMovementDTO $DTO, AbstractMovementInRoutineListViewModel $model): AbstractMovementInRoutineListViewModel
    {
        $model->id = $DTO->id;
        $model->name = $DTO->movement->name;
        $model->image = $DTO->movement->image;

        $model->targetReps = $DTO->targetReps ? $DTO->targetReps.'reps' : null;
        $model->targetWeight = $DTO->targetWeight ? ($DTO->targetWeight / 1000).'Kg' : null;
        $model->targetDuration = $DTO->targetDuration ? $DTO->targetDuration.'sec' : null;
        $model->targetDistance = $DTO->targetDistance ? $DTO->targetDistance.'m' : null;

        $model->targetRest = $DTO->targetRest ? $DTO->targetRest.'sec' : 'No rest';
        $model->numberOfSets = $DTO->numberOfSets;
        $model->generateWarmup = $DTO->generateWarmup ? 'Auto generated' : 'Not generated';

        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        return $model;
    }
}