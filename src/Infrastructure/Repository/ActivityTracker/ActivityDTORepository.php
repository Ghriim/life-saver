<?php

namespace App\Infrastructure\Repository\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Domain\Gateway\Provider\ActivityTracker\ActivityDTOProviderGateway;
use App\Infrastructure\Repository\Traits\AddCriteriaDateOfTheDayTrait;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

final class ActivityDTORepository extends ServiceEntityRepository implements ActivityDTOProviderGateway
{
    use AddCriteriaDateOfTheDayTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityDTO::class);
    }

    public function getActivitiesByUserIdAndDate(int $userId, DateTimeImmutable $date): array
    {
        $queryBuilder = $this->createQueryBuilder('activity')
                             ->andWhere('activity.userId = :userId')
                             ->setParameter('userId', $userId);

        return $this->addCriteriaDate($queryBuilder, $date, 'activity')
                    ->orderBy('activity.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }

    public function getActivityById(int $activityId): ?ActivityDTO
    {
        return $this->createQueryBuilder('activity')
                    ->andWhere('activity.id = :activityId')
                    ->setParameter('activityId', $activityId)
                    ->getQuery()->getOneOrNullResult();
    }

    public function getActivitiesByUserId(int $userId): array
    {
        return $this->createQueryBuilder('activity')
                    ->andWhere('activity.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->orderBy('activity.createDate', Criteria::DESC)
                    ->getQuery()->getResult();
    }
}