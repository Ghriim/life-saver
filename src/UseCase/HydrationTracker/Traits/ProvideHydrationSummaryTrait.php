<?php

namespace App\UseCase\HydrationTracker\Traits;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use DateTimeImmutable;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ProvideHydrationSummaryTrait
{
    private function provideSummary(int $userId, string $dateAsString): ?HydrationSummaryDTO
    {
        try {
            $date = new DateTimeImmutable($dateAsString);
        } catch (Exception) {
            throw new NotFoundHttpException();
        }

        if ($date > new DateTimeImmutable()) {
            throw new NotFoundHttpException();
        }

        return $this->summaryProviderGateway->getHydrationSummaryByUserIdAndDate($userId, $date);
    }
}
