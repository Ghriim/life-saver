<?php

namespace App\UseCase\Player\BodyTracker;

use App\Domain\Gateway\Provider\BodyTracker\WeightDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\BodyTracker\WeightListViewPresenter;
use App\UseCase\UseCaseInterface;

final class GetWeightsForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private WeightDTOProviderGateway $weightDTOGateway,
        private WeightListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId): array
    {
        $weightDTOs = $this->weightDTOGateway->getWeightsByUserId($userId);

        return $this->presenter->present($weightDTOs);
    }
}
