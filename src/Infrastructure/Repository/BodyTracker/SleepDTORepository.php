<?php

namespace App\Infrastructure\Repository\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\Gateway\Provider\BodyTracker\SleepDTOProviderGateway;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class SleepDTORepository extends ServiceEntityRepository implements SleepDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SleepDTO::class);
    }

    /**
     * @inheritDoc
     */
    public function getSleepById(int $sleepId): ?SleepDTO
    {
        return $this->createQueryBuilder('sleep')
                    ->andWhere('sleep.id = :sleepId')
                    ->setParameter('sleepId', $sleepId)
                    ->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function getSleepsByUserId(int $userId, ?DateTimeImmutable $dateStart, ?DateTimeImmutable $dateEnd): array
    {
        $queryBuilder = $this->createQueryBuilder('sleep')
                        ->andWhere('sleep.userId = :userId')
                        ->setParameter('userId', $userId)
                        ->orderBy('sleep.inBed', Criteria::DESC);


        if (null !== $dateStart) {
            $queryBuilder->andWhere('sleep.inBed >= :dateStart')
                         ->setParameter('dateStart', $dateStart);
        }

        if (null !== $dateEnd) {
            $queryBuilder->andWhere('sleep.inBed >= :dateEnd')
                         ->setParameter('dateEnd', $dateEnd);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
