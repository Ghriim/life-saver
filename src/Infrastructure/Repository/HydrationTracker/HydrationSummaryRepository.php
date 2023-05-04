<?php

namespace App\Infrastructure\Repository\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class HydrationSummaryRepository extends ServiceEntityRepository implements HydrationSummaryDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HydrationSummaryDTO::class);
    }

    /**
     * @inheritDoc
     */
    public function getHydrationSummaryById(int $summaryId): ?HydrationSummaryDTO
    {
        return $this->createQueryBuilder('summary')
                    ->andWhere('summary.id = :summaryId')
                    ->setParameter('summaryId', $summaryId)
                    ->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function getHydrationSummariesByUserId(int $userId): array
    {
        return $this->createQueryBuilder('summary')
                    ->andWhere('summary.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->orderBy('summary.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }

}