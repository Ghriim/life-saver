<?php

namespace App\Infrastructure\View\ViewPresenter\Admin\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\MovementInRoutineListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class MovementInRoutineListPresenter implements ViewPresenterInterface
{

    /**
     * @param RoutineToMovementDTO[] $DTOs
     *
     * @return MovementInRoutineListViewModel[]
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new MovementInRoutineListViewModel();
            $model->id = $DTO->id;
            $model->name = $DTO->movement->name;
            $model->image = $DTO->movement->image;

            $model->targetReps = $DTO->targetReps ? $DTO->targetReps.'reps' : null;
            $model->targetWeight = $DTO->targetWeight ? ($DTO->targetWeight / 1000).'Kg' : null;
            $model->targetDuration = $DTO->targetDuration ? $DTO->targetDuration.'sec' : null;
            $model->targetDistance = $DTO->targetDistance ? $DTO->targetDistance.'m' : null;

            $model->targetRest = $DTO->targetRest ? $DTO->targetRest.'sec' : 'No rest';
            $model->generateWarmup = $DTO->generateWarmup ? 'Auto generated' : 'Not generated';

            $model->added = DateTimeViewFormatter::toStringFormat($DTO->createDate);

            $models[] = $model;
        }

        return $models;
    }
}