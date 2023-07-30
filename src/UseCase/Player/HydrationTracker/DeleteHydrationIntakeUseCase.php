<?php

namespace App\UseCase\Player\HydrationTracker;

use App\Domain\Gateway\Persister\HydrationTracker\HydrationIntakeDTOPersisterGateway;
use App\Domain\Gateway\Persister\HydrationTracker\HydrationSummaryDTOPersisterGateway;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationIntakeDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteHydrationIntakeUseCase implements UseCaseInterface
{
    public function __construct(
        private HydrationIntakeDTOProviderGateway $intakeProviderGateway,
        private HydrationSummaryDTOPersisterGateway $summaryPersisterGateway,
        private HydrationIntakeDTOPersisterGateway $intakePersisterGateway,
    )
    {
    }

    public function execute(int $userId, int $intakeId): void
    {
        $intake = $this->intakeProviderGateway->getHydrationIntakeById($intakeId);
        if (null === $intake) {
            throw new NotFoundHttpException();
        }

        if ($userId !== $intake->summary->userId) {
            throw new AccessDeniedHttpException();
        }

        $summary = $intake->summary;
        $summary->dailyProgress -= $intake->volume;

        $this->summaryPersisterGateway->save($summary);
        $this->intakePersisterGateway->remove($intake);
    }
}