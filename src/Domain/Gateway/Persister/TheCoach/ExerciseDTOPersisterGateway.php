<?php

namespace App\Domain\Gateway\Persister\TheCoach;

use App\Domain\DTO\DTOInterface;
use App\Domain\DTO\TheCoach\ExerciseDTO;

interface ExerciseDTOPersisterGateway
{
    public function save(DTOInterface|ExerciseDTO $dto, bool $flush = true): null|DTOInterface|ExerciseDTO;

    public function remove(DTOInterface|ExerciseDTO $dto, bool $flush = true): void;
}