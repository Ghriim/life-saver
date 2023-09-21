<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\TheCoach\AdminRoutineListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetRoutinesUseCase implements UseCaseInterface
{
    public function __construct(
        public RoutineDTOProviderGateway $providerGateway,
        public AdminRoutineListViewPresenter $presenter,
    ) {

    }
    public function execute(?array $searchParameters): array
    {
        $routines = $this->providerGateway->getRoutines($searchParameters['title'] ?? null);

        return $this->presenter->present($routines);
    }
}