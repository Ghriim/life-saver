<?php

namespace App\Domain\DTO\User;

use App\Domain\DTO\AbstractBaseDTO;

class UserSettingsDTO extends AbstractBaseDTO
{
    public string $lang;

    public string $weightUnit;

    public string $distanceUnit;
}
