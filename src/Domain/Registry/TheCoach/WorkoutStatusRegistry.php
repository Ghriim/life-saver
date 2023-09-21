<?php

namespace App\Domain\Registry\TheCoach;

interface WorkoutStatusRegistry
{
    public const STATUS_PLANNED = 'planned';
    public const STATUS_IN_PROGRESS = 'in-progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_OVERDUE = 'overdue';


    public const TARGET_DATA_EDITABLE = [
        self::STATUS_PLANNED,
        self::STATUS_OVERDUE,
    ];

    public const COMPLETED_DATA_EDITABLE = [
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
    ];
}