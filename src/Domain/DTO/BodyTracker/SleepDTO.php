<?php

namespace App\Domain\DTO\BodyTracker;

use App\Domain\DTO\AbstractBaseDTO;
use DateTimeImmutable;

class SleepDTO extends AbstractBaseDTO
{
    public DateTimeImmutable $inBed;
    public ?DateTimeImmutable $outOfBed = null;

    /**
     * @var int|null Duration is in seconds
     */
    public ?int $duration = null;

    public int $userId;
}
