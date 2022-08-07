<?php

namespace App\Enums;

enum Exercise: string
{
    case Squat = 'squat';
    case Deadlift = 'deadlift';
    case BenchPress = 'bench_press';
    case OverheadPress = 'overhead_press';
    case Row = 'row';
}
