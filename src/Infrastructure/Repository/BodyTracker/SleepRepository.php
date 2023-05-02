<?php

namespace App\Infrastructure\Repository\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\Gateway\BodyTracker\GetSleepDTOGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class SleepRepository extends ServiceEntityRepository implements GetSleepDTOGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SleepDTO::class);
    }

    /**
     * @inheritDoc
     */
    public function getSleepsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('sleep')
                    ->andWhere('sleep.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->getQuery()->getResult();
    }
}
