<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\Gateway\Provider\TheCoach\ExerciseDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ExerciseDTORepository extends ServiceEntityRepository implements ExerciseDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseDTO::class);
    }

    public function getExerciseById(int $exerciseId): ?ExerciseDTO
    {
        return $this->createQueryBuilder('exercise')
                    ->leftJoin('exercise.workout', 'exercise_workout')
                    ->addSelect('exercise_workout')
                    ->andWhere('exercise.id = :exerciseId')
                    ->setParameter('exerciseId', $exerciseId)
                    ->getQuery()->getOneOrNullResult();
    }
}