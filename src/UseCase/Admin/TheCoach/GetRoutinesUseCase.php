<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Admin\TheCoach\RoutineListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetRoutinesUseCase implements UseCaseInterface
{
    public function __construct(
        public RoutineDTOProviderGateway $movementDTOGateway,
        public RoutineListViewPresenter $presenter,
    ) {

    }
    public function execute(?array $searchParameters): array
    {
        $routines = $this->movementDTOGateway->getRoutines($searchParameters['title'] ?? null);

        return $this->presenter->present($routines);
    }
}