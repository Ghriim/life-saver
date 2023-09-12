<?php

namespace App\UseCase\Admin\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use App\Infrastructure\View\ViewModel\Admin\TheCoach\AdminRoutineDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\Admin\TheCoach\AdminRoutineDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetRoutineUseCase implements UseCaseInterface
{
    public function __construct(
        public RoutineDTOProviderGateway $routineDTOGateway,
        public AdminRoutineDetailsViewPresenter $presenter,
    ) {

    }
    public function execute(int $routineId): AdminRoutineDetailsViewModel
    {
        $routine = $this->routineDTOGateway->getRoutineById($routineId);
        if (null === $routine) {
            throw new NotFoundHttpException();
        }

        return $this->presenter->present($routine);
    }
}