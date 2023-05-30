<?php

namespace App\Domain\DTO\ActivityTracker;

use App\Domain\DTO\AbstractBaseDTO;

class ActivityTypeDTO extends AbstractBaseDTO
{
    public string $title;

    public ActivityCategoryDTO $activityCategory;
}