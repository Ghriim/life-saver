<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Domain\Gateway\Provider\TheCoach\EquipmentDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EquipmentDTORepository extends ServiceEntityRepository implements EquipmentDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipmentDTO::class);
    }
    public function getEquipments(?string $name): array
    {
        $queryBuilder =  $this->createQueryBuilder('equipment');

        if (null !== $name) {
            $queryBuilder->andWhere('equipment.name LIKE :name')
                         ->setParameter('name', '%'.$name.'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
