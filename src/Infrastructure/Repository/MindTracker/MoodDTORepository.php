<?php

namespace App\Infrastructure\Repository\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\Infrastructure\Repository\Traits\AddCriteriaDateOfTheDayTrait;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class MoodDTORepository extends ServiceEntityRepository implements MoodDTOProviderGateway
{
    use AddCriteriaDateOfTheDayTrait;

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

    /**
     * @inheritDoc
     */
    public function getMoodsByUserIdAndDate(int $userId, DateTimeImmutable $date): array
    {
        $queryBuilder = $this->createQueryBuilder('mood')
                    ->andWhere('mood.userId = :userId')
                    ->setParameter('userId', $userId);

        return $this->addCriteriaDate($queryBuilder, $date, 'mood')
                    ->orderBy('mood.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }
}
