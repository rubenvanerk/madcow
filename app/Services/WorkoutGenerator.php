<?php

namespace App\Services;

use App\Enums\Exercise;
use App\Models\Set;
use App\Models\User;
use App\Models\Workout;
use App\Values\RepMax;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Str;

class WorkoutGenerator
{
    protected User $user;

    protected string $weekColumnMap = 'EFGHIJKLMNOP';

    /**
     * @var array<string, int>
     */
    protected array $exerciseIndex = [
        'squat' => 0,
        'bench_press' => 1,
        'row' => 2,
        'overhead_press' => 1,
        'deadlift' => 2,
    ];

    /**
     * @var array<int, int>
     */
    protected array $dayRowMap = [
        Carbon::MONDAY => 10,
        Carbon::WEDNESDAY => 25,
        Carbon::FRIDAY => 37,
    ];

    /**
     * @var array<int, int>
     */
    protected array $setsByDay = [
        Carbon::MONDAY => 5,
        Carbon::WEDNESDAY => 4,
        Carbon::FRIDAY => 6,
    ];

    /**
     * @var array<int, string[]>
     */
    protected array $workoutsByDay = [
        Carbon::MONDAY => [
            'squat',
            'bench_press',
            'row',
        ],
        Carbon::WEDNESDAY => [
            'squat',
            'overhead_press',
            'deadlift',
        ],
        Carbon::FRIDAY => [
            'squat',
            'bench_press',
            'row',
        ],
    ];

    /**
     * @var array<string, int>
     */
    protected array $repMaxRows = [
        'squat' => 9,
        'bench_press' => 10,
        'row' => 11,
        'overhead_press' => 12,
        'deadlift' => 13,
    ];

    public function generateForUser(User $user): void
    {
        $this->user = $user;

        for ($i = 1; $i <= 12; $i++) {
            $this->generateWorkout($i, Carbon::MONDAY)->save();
            $this->generateWorkout($i, Carbon::WEDNESDAY)->save();
            $this->generateWorkout($i, Carbon::FRIDAY)->save();
        }
    }

    public function generateWorkout(int $week, int $day): Workout
    {
        $exercises = $this->workoutsByDay[$day];

        $workout = Workout::create([
            'user_id' => $this->user->id,
            'day' => $day,
        ]);

        foreach ($exercises as $exercise) {
            $repMax = $this->user->rep_maxes[$exercise];
            $this->generateSets($week, $day, $repMax)->each(fn (Set $set) => $workout->sets()->save($set));
        }

        return $workout;
    }

    /**
     * @param  int  $day
     * @param  int  $week
     * @param  RepMax  $repMax
     * @return Collection<int, Set>
     */
    public function generateSets(int $week, int $day, RepMax $repMax): Collection
    {
        $spreadsheet = IOFactory::load(app_path('Data/stronglifts-madcow-5x5.xls'));

        $inputSheet = $spreadsheet->getSheetByName('Start Here');
        $programSheet = $spreadsheet->getSheetByName('Madcow Program');

        if (! $inputSheet || ! $programSheet) {
            return new Collection();
        }

        $row = $this->repMaxRows[$repMax->exercise->value];

        $inputSheet->setCellValue('C'.$row, $repMax->weight);
        $inputSheet->setCellValue('D'.$row, $repMax->reps);

        return $this->getSets($programSheet, $repMax->exercise, $week, $day);
    }

    /**
     * @param Worksheet $programSheet
     * @param Exercise $exercise
     * @param int $week
     * @param int $day
     * @return Collection<int, Set>
     */
    private function getSets(Worksheet $programSheet, Exercise $exercise, int $week, int $day): Collection
    {
        $column = Str::of($this->weekColumnMap)->substr($week - 1, 1)->toString();
        $numberOfSets = $this->setsByDay[$day];
        $exerciseOffset = $this->exerciseIndex[$exercise->value];
        $rowStart = $this->dayRowMap[$day] + $exerciseOffset * $numberOfSets;
        $rowEnd = $rowStart + $numberOfSets - 1;

        $setReps = array_column($programSheet->rangeToArray("D$rowStart:D{$rowEnd}"), 0);
        $setWeights = array_column($programSheet->rangeToArray("{$column}{$rowStart}:{$column}{$rowEnd}"), 0);
        $sets = new Collection();

        for ($i = 0; $i < $numberOfSets; $i++) {
            $sets->add(new Set([
                'weight' => $setWeights[$i],
                'target_reps' => $setReps[$i],
                'exercise' => $exercise->value,
            ]));
        }

        return $sets;
    }
}
