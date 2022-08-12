<?php

namespace App\Enums;

enum Exercise: string
{
    case Squat = 'squat';
    case Deadlift = 'deadlift';
    case BenchPress = 'bench_press';
    case OverheadPress = 'overhead_press';
    case Row = 'row';

    public function name(): string
    {
        return match ($this) {
            self::Squat => 'Squat',
            self::Deadlift => 'Deadlift',
            self::BenchPress => 'Bench press',
            self::OverheadPress => 'Overhead press',
            self::Row => 'Row',
        };
    }
}
