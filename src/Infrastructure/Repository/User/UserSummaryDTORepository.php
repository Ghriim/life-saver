<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\User\UserSummaryDTO;
use App\Domain\Gateway\Provider\User\UserSummaryDTOProviderGateway;
use App\Infrastructure\Repository\Traits\AddCriteriaDateOfTheDayTrait;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class UserSummaryDTORepository extends ServiceEntityRepository implements UserSummaryDTOProviderGateway
{
    use AddCriteriaDateOfTheDayTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSummaryDTO::class);
    }

    public function getUserSummaryByUserIdAndDate(int $userId, DateTimeImmutable $date): ?UserSummaryDTO
    {
        $queryBuilder = $this->createQueryBuilder('user_summary')
                             ->andWhere('user_summary.user = :userId')
                             ->setParameter('userId', $userId);

        return $this->addCriteriaDate($queryBuilder, $date, 'user_summary')
                    ->getQuery()->getOneOrNullResult();
    }
}