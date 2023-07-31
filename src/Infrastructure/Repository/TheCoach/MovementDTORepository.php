<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\Gateway\Provider\TheCoach\MovementDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovementDTORepository extends ServiceEntityRepository implements MovementDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovementDTO::class);
    }
    public function getMovements(?string $name): array
    {
        $queryBuilder =  $this->createQueryBuilder('movement')
                              ->addOrderBy('movement.name');

        if (null !== $name) {
            $queryBuilder->andWhere('movement.name LIKE :name')
                         ->setParameter('name', '%'.$name.'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function getMovementById(int $movementId): ?MovementDTO
    {
        $queryBuilder =  $this->createQueryBuilder('movement')
                              ->andWhere('movement.id = :movementId')
                              ->setParameter('movementId', $movementId);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}

