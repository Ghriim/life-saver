<?php

namespace App\UseCase\Player\BodyTracker;

use App\Domain\Gateway\Persister\BodyTracker\SleepDTOPersisterGateway;
use App\Domain\Gateway\Provider\BodyTracker\SleepDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteSleepUseCase implements UseCaseInterface
{
    public function __construct(
        private SleepDTOProviderGateway $providerGateway,
        private SleepDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $sleepId): void
    {
        $sleep = $this->providerGateway->getSleepById($sleepId);
        if (null === $sleep) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($sleep);
    }
}
