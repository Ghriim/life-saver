<?php

namespace App\Infrastructure\View\ViewFormatter;

final class PercentageViewFormatter
{
    public static function toStringFormat(float $a, float $b, int $decimalsToDisplay = 0): string
    {
        $pctValue = ($a / $b) * 100;
        if (0 === $decimalsToDisplay) {
            return (string) floor($pctValue);
        }

        return (string) round($pctValue, $decimalsToDisplay);
    }
}