<?php

namespace App\UseCase\Player\ActivityTracker;

use App\Domain\Gateway\Provider\ActivityTracker\ActivityDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\ActivityTracker\ActivityListViewPresenter;
use App\UseCase\UseCaseInterface;
use DateTimeImmutable;

final class GetActivitiesForUserUseCase implements UseCaseInterface
{
    public function __construct(
        private ActivityDTOProviderGateway $activityDTOGateway,
        private ActivityListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, ?string $date): array
    {
        if (null === $date) {
            $activities = $this->activityDTOGateway->getActivitiesByUserId($userId);
        } else {
            $activities = $this->activityDTOGateway->getActivitiesByUserIdAndDate($userId, new DateTimeImmutable($date));
        }

        return $this->presenter->present($activities);
    }
}
