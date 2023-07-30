<?php

namespace App\UseCase\Player\ActivityTracker;

use App\Domain\Gateway\Persister\ActivityTracker\ActivityDTOPersisterGateway;
use App\Domain\Gateway\Provider\ActivityTracker\ActivityDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteActivityUseCase implements UseCaseInterface
{
    public function __construct(
        private ActivityDTOProviderGateway $providerGateway,
        private ActivityDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $activityId): void
    {
        $activity = $this->providerGateway->getActivityById($activityId);
        if (null === $activity) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($activity);
    }
}