<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\EquipmentDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\TheCoach\EquipmentListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetEquipmentsUseCase implements UseCaseInterface
{
    public function __construct(
        public EquipmentDTOProviderGateway $equipmentDTOGateway,
        public EquipmentListViewPresenter $presenter,
    ) {

    }
    public function execute(?array $searchParameters): array
    {
        $equipments = $this->equipmentDTOGateway->getEquipments($searchParameters['name'] ?? null);

        return $this->presenter->present($equipments);
    }
}