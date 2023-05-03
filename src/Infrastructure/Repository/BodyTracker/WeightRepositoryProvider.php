<?php

namespace App\Infrastructure\Repository\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Domain\Gateway\Provider\BodyTracker\WeightDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class WeightRepositoryProvider extends ServiceEntityRepository implements WeightDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeightDTO::class);
    }

    /**
     * @inheritDoc
     */
    public function getWeightById(int $weightId): ?WeightDTO
    {
        return $this->createQueryBuilder('weight')
                    ->andWhere('weight.id = :weightId')
                    ->setParameter('weightId', $weightId)
                    ->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function getWeightsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('weight')
                    ->andWhere('weight.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->orderBy('weight.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }
}
