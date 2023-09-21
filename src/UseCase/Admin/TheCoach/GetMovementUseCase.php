<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use App\Infrastructure\View\ViewModel\TheCoach\MovementDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\TheCoach\MovementDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetMovementUseCase implements UseCaseInterface
{
    public function __construct(
        public MovementDTOProviderGateway $movementDTOGateway,
        public MovementDetailsViewPresenter $presenter,
    ) {

    }
    public function execute(int $movementId): MovementDetailsViewModel
    {
        $movement = $this->movementDTOGateway->getMovementById($movementId);
        if (null === $movement) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($movement);
    }
}