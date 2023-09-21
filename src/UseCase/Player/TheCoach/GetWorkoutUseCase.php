<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Infrastructure\View\ViewModel\TheCoach\WorkoutDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\TheCoach\WorkoutDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetWorkoutUseCase implements UseCaseInterface
{
    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOProviderGateway,
        private WorkoutDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $workoutId): WorkoutDetailsViewModel
    {
        $workout = $this->workoutDTOProviderGateway->getWorkoutByIdForDetails($workoutId);
        if (null === $workout) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($workout);
    }
}