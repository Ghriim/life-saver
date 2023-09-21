<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\TheCoach\AdminMovementListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetMovementsUseCase implements UseCaseInterface
{
    public function __construct(
        public MovementDTOProviderGateway $movementDTOGateway,
        public AdminMovementListViewPresenter $presenter,
    ) {

    }
    public function execute(?array $searchParameters): array
    {
        $movements = $this->movementDTOGateway->getMovements($searchParameters['name'] ?? null);

        return $this->presenter->present($movements);
    }
}