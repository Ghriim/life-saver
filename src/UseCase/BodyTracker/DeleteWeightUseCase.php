<?php

namespace App\UseCase\BodyTracker;

use App\Domain\Gateway\Persister\BodyTracker\WeightDTOPersisterGateway;
use App\Domain\Gateway\Provider\BodyTracker\WeightDTOProviderGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteWeightUseCase implements UseCaseInterface
{
    public function __construct(
        private WeightDTOProviderGateway $providerGateway,
        private WeightDTOPersisterGateway $persisterGateway
    ) {

    }

    public function execute(int $weightId): void
    {
        $weight = $this->providerGateway->getWeightById($weightId);
        if (null === $weight) {
            throw new NotFoundHttpException();
        }

        $this->persisterGateway->remove($weight);
    }
}
