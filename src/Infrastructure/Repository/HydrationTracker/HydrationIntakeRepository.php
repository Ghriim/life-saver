<?php

namespace App\Infrastructure\Repository\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationIntakeDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class HydrationIntakeRepository extends ServiceEntityRepository implements HydrationIntakeDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HydrationIntakeDTO::class);
    }

    public function getHydrationIntakeById(int $intakeId): ?HydrationIntakeDTO
    {
        return $this->createQueryBuilder('intake')
                    ->andWhere('intake.id = :intakeId')
                    ->setParameter('intakeId', $intakeId)
                    ->leftJoin('intake.summary', 'intake_summary')
                    ->getQuery()->getOneOrNullResult();
    }

    /**
     * @return HydrationIntakeDTO[]
     */
    public function getHydrationIntakesBySummary(HydrationSummaryDTO $summary): array
    {
        return $this->createQueryBuilder('intake')
                    ->andWhere('intake.summary = :summary')
                    ->setParameter('summary', $summary)
                    ->getQuery()->getResult();
    }
}