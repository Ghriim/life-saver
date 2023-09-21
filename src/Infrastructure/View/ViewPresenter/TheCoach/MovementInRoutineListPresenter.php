<?php

namespace App\Infrastructure\View\ViewPresenter\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewFormatter\WeightViewFormatter;
use App\Infrastructure\View\ViewModel\TheCoach\MovementInRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MovementInRoutineListPresenter implements ViewPresenterInterface
{
    PUBLIC function present(RoutineToMovementDTO $DTO): MovementInRoutineListViewModel
    {
        $model = new MovementInRoutineListViewModel();

        $model->id = $DTO->id;
        $model->name = $DTO->movement->name;
        $model->image = $DTO->movement->image;

        $model->targetReps = $DTO->targetReps ? $DTO->targetReps.'reps' : null;
        $model->targetWeight = $DTO->targetWeight ? WeightViewFormatter::toKGStringFormat($DTO->targetWeight) : null;
        $model->targetDuration = $DTO->targetDuration ? $DTO->targetDuration.'sec' : null;
        $model->targetDistance = $DTO->targetDistance ? $DTO->targetDistance.'m' : null;

        $model->targetRest = $DTO->targetRest ? $DTO->targetRest.'sec' : 'No rest';
        $model->numberOfSets = $DTO->numberOfSets;
        $model->warmupPattern = null === $DTO->warmupPattern ? 'none' : $DTO->warmupPattern->pattern;

        $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

        return $model;
    }
}