<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\View\ViewModel\TheCoach\RoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\TheCoach\RoutineDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        private RoutineDTOProviderGateway $routineDTOProviderGateway,
        public RoutineDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $routineId): RoutineDetailsViewModel
    {
        $routine = $this->routineDTOProviderGateway->getRoutineById($routineId);
        if (null === $routine) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($routine);
    }
}