<?php

namespace App\Domain\DTO\MindTracker;

use App\Domain\DTO\AbstractBaseDTO;

class MoodDTO extends AbstractBaseDTO
{
    public int $level;

    public ?string $description;

    public int $userId;
}