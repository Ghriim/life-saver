<?php

namespace App\Domain\Gateway\Provider\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;

interface ExerciseDTOProviderGateway
{
    public function getExerciseById(int $exerciseId): ?ExerciseDTO;
}