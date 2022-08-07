<?php

namespace App\Http\Livewire;

use App\Models\Set;
use Livewire\Component;
use App\Models\Workout as WorkoutModel;

class Workout extends Component
{
    public WorkoutModel $workout;

    public function render()
    {
        return view('livewire.workout');
    }

    public function updateCompletedReps(Set $set): void
    {
        if ($this->workout->started_at === null) {
            $this->workout->touch('started_at');
        }

        if ($set->completed_reps === 0) {
            $set->update(['completed_reps' => null]);
            return;
        }

        if ($set->completed_reps === null) {
            $set->update(['completed_reps' => $set->target_reps]);
            return;
        }

        $set->decrement('completed_reps');
    }

    public function toggleCompletedAt(): void
    {
        if ($this->workout->completed_at === null) {
            $this->workout->touch('completed_at');
        } else {
            $this->workout->update(['completed_at' => null]);
        }
    }
}
