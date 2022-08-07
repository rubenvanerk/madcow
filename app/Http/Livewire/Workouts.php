<?php

namespace App\Http\Livewire;

use App\Services\WorkoutGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

class Workouts extends Component
{
    public Collection $workouts;

    public function mount(Request $request): void
    {
        $this->workouts = $request->user()->workouts()->whereNull('completed_at')->with('sets')->get();
    }

    public function render(): View
    {
        return view('livewire.workouts');
    }

    public function generateWorkouts(Request $request): void
    {
        $request->user()->workouts()->whereNull('completed_at')->delete();
        app(WorkoutGenerator::class)->generateForUser($request->user());

        $this->workouts = $request->user()->workouts()->whereNull('completed_at')->with('sets')->get();
    }
}
