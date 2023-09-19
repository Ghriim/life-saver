<?php

namespace App\Infrastructure\Repository\TheCoach;

use App\Domain\DTO\TheCoach\WorkoutDTO;
use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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
                    ->andWhere('workout.id = :workoutId')
                    ->setParameter('workoutId', $workoutId)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function getWorkoutByIdForDetails(int $workoutId): ?WorkoutDTO
    {
        return $this->createQueryBuilder('workout')
                    ->leftJoin('workout.exercises', 'workout_exercise')
                    ->addSelect('workout_exercise')
                    ->leftJoin('workout_exercise.movement', 'workout_exercise_movement')
                    ->addSelect('workout_exercise_movement')
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
        return $this->createQueryBuilderForWorkoutsByUserId($userId)
                    ->andWhere('workout.plannedDate <= :date OR workout.startedDate <= :date OR workout.completedDate <= :date')
                    ->setParameter('date', $date)
                    ->getQuery()
                    ->getResult();
    }

    public function getWorkoutsPlannedByUserIdAndDate(int $userId, DateTimeImmutable $date): array
    {
        return $this->createQueryBuilderForWorkoutsByUserId($userId)
                    ->andWhere('workout.plannedDate >= :date')
                    ->setParameter('date', $date)
                    ->andWhere('workout.startedDate IS NULL and workout.completedDate IS NULL')
                    ->getQuery()
                    ->getResult();
    }

    public function getWorkoutsByUserIdForDate(int $userId, DateTimeImmutable $date): array
    {
        $beginningOfTheDay = $date->modify('00:00:00')->format(DATE_ATOM);
        $endOfTheDay = $date->modify('23:59:59')->format(DATE_ATOM);

        $qb = $this->createQueryBuilderForWorkoutsByUserId($userId);

        return $qb->andWhere(
            $qb->expr()->orX(
                'workout.plannedDate BETWEEN :startDate AND :endDate',
                'workout.completedDate BETWEEN :startDate AND :endDate',
            ))
            ->setParameter('startDate', $beginningOfTheDay)
            ->setParameter('endDate', $endOfTheDay)
            ->getQuery()->getResult();
    }

    private function createQueryBuilderForWorkoutsByUserId(int $userId): QueryBuilder
    {
        return $this->createQueryBuilder('workout')
                    ->andWhere('workout.userId = :userId')
                    ->setParameter('userId', $userId);
    }
}