<?php

namespace App\Domain\DataTransformer\TheCoach;

final class WarmupPatternDataTransformer
{
    public static function patternToWeights(string $pattern, int $targetWeight): array
    {
        if (false === str_starts_with($pattern, 'Weight')) {
            return [];
        }

        $start = strpos($pattern, '[');
        $pattern = substr($pattern, $start+1);

        $end = strpos($pattern, ']');
        $pattern = substr($pattern, 0, $end);

        $configs = [];
        foreach (explode('-', $pattern) as $setConfig) {
            $end = strpos($setConfig, 'x');
            $reps = (int)  substr($setConfig, 0, $end);

            $start = strpos($setConfig, 'x');
            $weightAsString = substr($setConfig, $start+1);

            $weight = null;
            if (str_contains($weightAsString, 'Kg')) {
                $end = strpos($weightAsString, 'Kg');
                $weight = (int) substr($weightAsString, 0, $end);
            } elseif (str_contains($weightAsString, '%W')) {
                $end = strpos($weightAsString, '%W');
                $pctWeight = (int) substr($weightAsString, 0, $end);

                $weight = ($targetWeight * $pctWeight) / 100;
            }

            $configs[] = [
                'reps' => $reps,
                'weight' => $weight
            ];
        }

        return $configs;
    }
}