<?php

namespace App\Domain\DTO\ActivityTracker;

use App\Domain\DTO\AbstractBaseDTO;

class ActivityDTO extends AbstractBaseDTO
{
    public ?string $title = null;

    public int $userId;

    public ?ActivityTypeDTO $activityType = null;
}