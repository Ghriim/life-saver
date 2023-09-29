<?php

namespace App\UseCase\Player\HydrationTracker\Traits;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use DateTimeImmutable;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ProvideHydrationSummaryTrait
{
    private function provideSummary(int $userId, \DateTimeImmutable $date): ?HydrationSummaryDTO
    {
        if ($date > new DateTimeImmutable()) {
            throw new NotFoundHttpException();
        }

        return $this->summaryProviderGateway->getHydrationSummaryByUserIdAndDate($userId, $date);
    }
}
