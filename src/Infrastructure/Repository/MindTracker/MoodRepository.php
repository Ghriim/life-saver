<?php

namespace App\Infrastructure\Repository\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class MoodRepository extends ServiceEntityRepository implements MoodDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoodDTO::class);
    }

    /**
     * @inheritDoc
     */
    public function getMoodById(int $moodId): ?MoodDTO
    {
        return $this->createQueryBuilder('mood')
                    ->andWhere('mood.id = :moodId')
                    ->setParameter('moodId', $moodId)
                    ->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function getMoodsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('mood')
                    ->andWhere('mood.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->orderBy('mood.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }
}
