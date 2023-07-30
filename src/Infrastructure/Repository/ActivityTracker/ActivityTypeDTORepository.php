<?php

namespace App\Infrastructure\Repository\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityTypeDTO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ActivityTypeDTORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityTypeDTO::class);
    }
}