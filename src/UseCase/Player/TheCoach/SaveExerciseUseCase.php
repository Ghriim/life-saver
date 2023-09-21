<?php

namespace App\UseCase\Player\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\Gateway\Persister\TheCoach\ExerciseDTOPersisterGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final class SaveExerciseUseCase implements UseCaseInterface
{
    public function __construct(
        private ExerciseDTOPersisterGateway $persisterGateway,
    ) {

    }

    public function execute(ExerciseDTO $exerciseDTO, int $userId): ExerciseDTO
    {
        if ($userId !== $exerciseDTO->workout->userId) {
            throw new AccessDeniedHttpException();
        }

        $this->persisterGateway->save($exerciseDTO);

        return $exerciseDTO;
    }
}