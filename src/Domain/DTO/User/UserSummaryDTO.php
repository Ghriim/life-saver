<?php

namespace App\Domain\DTO\User;

use App\Domain\DTO\AbstractBaseDTO;

class UserSummaryDTO extends AbstractBaseDTO
{
    public array $activityTracker = [];
    public array $bodyTracker = [];
    public array $hydrationTracker = [];
    public array $theCoach = [];
    public array $theLibrarian = [];

    public UserDTO $user;
}
