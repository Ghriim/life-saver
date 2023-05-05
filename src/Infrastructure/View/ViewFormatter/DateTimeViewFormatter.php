<?php

namespace App\Infrastructure\View\ViewFormatter;

use DateTimeInterface;

final class DateTimeViewFormatter
{
    private const DEFAULT_SHORT_FORMAT = 'Y-m-d';
    private const DEFAULT_FORMAT = self::DEFAULT_SHORT_FORMAT.' H:i:s';

    public static function toStringFormat(DateTimeInterface $dateTime, bool $shortVersion = false): string
    {
        if (true === $shortVersion) {
            return $dateTime->format(self::DEFAULT_SHORT_FORMAT);
        }

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