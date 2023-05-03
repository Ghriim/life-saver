<?php

namespace App\Domain\DTO\BodyTracker;

use App\Domain\DTO\AbstractBaseDTO;

class WeightDTO extends AbstractBaseDTO
{
    /**
     * @var int Duration is in grams
     */
    public int $weight;

    public int $userId;
}
