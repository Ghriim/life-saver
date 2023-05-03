<?php

namespace App\Infrastructure\View\ViewFormatter;

final class WeightViewFormatter
{
    public static function toKGFormat(int $weightInGrams): string
    {
        $weightInKg = $weightInGrams / 1000;

        return (string) $weightInKg;
    }
}