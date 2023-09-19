<?php

namespace App\Domain\Registry\TheCoach;

interface ExerciseSetTypeRegistry
{
    public const SET_TYPE_WARMUP = 'warmup';
    public const SET_TYPE_WORK = 'work';
    public const SET_TYPE_DROP = 'drop';
    public const SET_TYPE_FAILED = 'failed';
}