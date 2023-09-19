<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\Gateway\Provider\TheCoach\WorkoutDTOProviderGateway;
use App\Infrastructure\View\ViewPresenter\Player\TheCoach\WorkoutListViewPresenter;
use App\UseCase\UseCaseInterface;
use \DateTimeImmutable;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class GetWorkoutsForUserUseCase implements UseCaseInterface
{
    public const CONTEXT_SPECIFIC_DATE = 'specific-date';
    public const CONTEXT_HISTORY = 'history';
    public const CONTEXT_PLANNED = 'planned';

    public function __construct(
        private WorkoutDTOProviderGateway $workoutDTOGateway,
        private WorkoutListViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, string $context, ?string $date): array
    {
        try {
            $date = new DateTimeImmutable($date);
        } catch (\Exception) {
            throw new BadRequestHttpException('Invalid "date" requested');
        }

        if (self::CONTEXT_SPECIFIC_DATE === $context) {
            $workouts = $this->workoutDTOGateway->getWorkoutsByUserIdForDate($userId, $date);
        } elseif (self::CONTEXT_HISTORY === $context) {
            $workouts = $this->workoutDTOGateway->getWorkoutsHistoryByUserIdAndDate($userId, $date);
        } elseif (self::CONTEXT_PLANNED === $context) {
            $workouts = $this->workoutDTOGateway->getWorkoutsPlannedByUserIdAndDate($userId, $date);
        } else {
            throw new BadRequestHttpException('Invalid "context" requested');
        }

        return $this->presenter->present($workouts);
    }
}