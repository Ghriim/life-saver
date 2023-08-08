<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\RoutineDTO;
use App\Domain\Gateway\Provider\TheCoach\RoutineDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RoutineDTORepository extends ServiceEntityRepository implements RoutineDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoutineDTO::class);
    }

    public function getRoutines(?string $title): array
    {
        $queryBuilder =  $this->createQueryBuilder('routine')
                              ->addOrderBy('routine.title');

        if (null !== $title) {
            $queryBuilder->andWhere('routine.title LIKE :title')
                         ->setParameter('title', '%'.$title.'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function getRoutineById(int $routineId): ?RoutineDTO
    {
        $queryBuilder =  $this->createQueryBuilder('routine')
                              ->leftJoin('routine.movements', 'routine_movement')
                              ->addSelect('routine_movement')
                              ->leftJoin('routine_movement.movement', 'movement')
                              ->addSelect('movement')
                              ->andWhere('routine.id = :routineId')
                              ->setParameter('routineId', $routineId);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}

