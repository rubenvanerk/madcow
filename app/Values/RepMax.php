<?php

namespace App\Values;

use App\Enums\Exercise;
use App\Services\RepMaxCalculator;

class RepMax
{
    public function __construct(
        public Exercise $exercise,
        public int $weight,
        public int $reps
    ) {
    }

    public function getOneRepMax(): int
    {
        return app(RepMaxCalculator::class)->calculate($this->weight, $this->reps);
    }

    public function getFiveRepMax(): int
    {
        return app(RepMaxCalculator::class)->calculate($this->getOneRepMax(), 5);
    }
}
