<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\TheCoach\PlayerRoutineListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetRoutinesUseCase implements UseCaseInterface
{
    public function __construct(
        public RoutineDTOProviderGateway $providerGateway,
        public PlayerRoutineListViewPresenter $presenter,
    ) {

    }

    public function execute(int $currentUserId): array
    {
        $routines = $this->providerGateway->getRoutines(null);

        return $this->presenter->present($routines);
    }
}