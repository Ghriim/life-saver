<?php

namespace App\Infrastructure\View\ViewFormatter;

final class WeightViewFormatter
{
    public static function toKGStringFormat(?int $weightInGrams): string
    {
        if (null === $weightInGrams) {
            return '0Kg';
        }

        return ($weightInGrams / 1000).'Kg';
    }
}