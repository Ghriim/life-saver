<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Domain\Gateway\Provider\TheCoach\RoutineToMovementDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RoutineToMovementDTORepository extends ServiceEntityRepository implements RoutineToMovementDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoutineToMovementDTO::class);
    }

    public function getRoutineToMovementById(int $routineToMovementId): ?RoutineToMovementDTO
    {
        $queryBuilder =  $this->createQueryBuilder('routine_to_movement')
                              ->andWhere('routine_to_movement.id = :routineToMovementId')
                              ->setParameter('routineToMovementId', $routineToMovementId);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}