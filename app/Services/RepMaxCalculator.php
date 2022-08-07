<?php

namespace App\Services;

class RepMaxCalculator
{
    public static function calculate(int $weight, int $reps): int
    {
        return (int) round($weight / (1.0278 - 0.0278 * $reps));
    }
}
