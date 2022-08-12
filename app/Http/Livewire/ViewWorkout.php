<?php

namespace App\Http\Livewire;

use App\Models\Workout;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ViewWorkout extends Component
{
    public Workout $workout;

    public function render(): View
    {
        $setsByExercise = $this->workout->sets()->get()->groupBy('exercise');

        return view('livewire.view-workout', compact('setsByExercise'));
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
