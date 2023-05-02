<?php

namespace App\Infrastructure\View\ViewFormatter;

use DateTimeInterface;

final class DateTimeViewFormatter
{
    private const DEFAULT_FORMAT = 'Y-m-d H:i:s';

    public static function toStringFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::DEFAULT_FORMAT);
    }

    public static function dayOfDateToString(DateTimeInterface $dateTime): string
    {
        $dateToString = self::toStringFormat($dateTime);
        return explode(" ", $dateToString)[0];
    }

    public static function hourOfDateToString(DateTimeInterface $dateTime): string
    {
        $dateToString = self::toStringFormat($dateTime);
        return explode(" ", $dateToString)[1];
    }
}