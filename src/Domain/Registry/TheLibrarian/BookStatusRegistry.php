<?php

namespace App\Domain\Registry\TheLibrarian;

interface BookStatusRegistry
{
    public const STATUS_CREATED = 'created';
    public const STATUS_VALIDATED = 'validated';
    public const STATUS_DELETED = 'deleted';
}