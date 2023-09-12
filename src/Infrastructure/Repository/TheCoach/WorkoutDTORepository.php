<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class WorkoutDTORepository extends ServiceEntityRepository implements WorkoutDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkoutDTO::class);
    }

    public function getWorkoutById(int $workoutId): ?WorkoutDTO
    {
        return $this->createQueryBuilder('workout')
                    ->leftJoin('workout.exercises', 'workout_exercise')
                    ->addSelect('workout_exercise')
                    ->leftJoin('workout.routine', 'workout_routine')
                    ->addSelect('workout_routine')
                    ->andWhere('workout.id = :workoutId')
                    ->setParameter('workoutId', $workoutId)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function getWorkoutsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('workout')
                    ->andWhere('workout.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->getQuery()
                    ->getResult();
    }

    public function getWorkoutsHistoryByUserIdAndDate(int $userId, DateTimeImmutable $date): array
    {
        return $this->createQueryBuilder('workout')
                    ->andWhere('workout.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->andWhere('workout.plannedDate <= :date OR workout.startedDate <= :date OR workout.completedDate <= :date')
                    ->setParameter('date', $date)
                    ->getQuery()
                    ->getResult();
    }

    public function getWorkoutsPlannedByUserIdAndDate(int $userId, DateTimeImmutable $date): array
    {
        return $this->createQueryBuilder('workout')
                    ->andWhere('workout.userId = :userId')
                    ->setParameter('userId', $userId)
                    ->andWhere('workout.plannedDate >= :date')
                    ->setParameter('date', $date)
                    ->andWhere('workout.startedDate IS NULL and workout.completedDate IS NULL')
                    ->getQuery()
                    ->getResult();
    }
}