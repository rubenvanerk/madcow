<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Workout;
use App\Services\WorkoutGenerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListWorkouts extends Component
{
    /**
     * @var Collection<int, Workout>
     */
    public Collection $workouts;

    public Collection $setsByExercise;

    public bool $past = false;

    public function mount(Request $request): void
    {
        /** @var User $user */
        $user = $request->user();

        if ($this->past) {
            $this->workouts = $user->workouts()->whereNotNull('completed_at')->with('sets')->get();
        } else {
            $this->workouts = $user->workouts()->whereNull('completed_at')->with('sets')->get();
        }
    }

    public function render(): View
    {
        return view('livewire.list-workouts');
    }

    public function generateWorkouts(Request $request): void
    {
        /** @var User $user */
        $user = $request->user();

        $user->workouts()->whereNull('completed_at')->delete();
        app(WorkoutGenerator::class)->generateForUser($user);

        $this->workouts = $user->workouts()->whereNull('completed_at')->with('sets')->get();
    }
}
