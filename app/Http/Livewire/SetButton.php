<?php

namespace App\Http\Livewire;

use App\Models\Set;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SetButton extends Component
{
    public Set $set;

    public ?int $completedReps = null;

    public function mount(): void
    {
        $this->completedReps = $this->set->completed_reps;
    }

    public function render(): View
    {
        return view('livewire.set-button');
    }

    public function updatedCompletedReps(): void
    {
        if ($this->set->workout && $this->set->workout->started_at === null) {
            $this->set->workout->touch('started_at');
        }

        $this->set->update(['completed_reps' => $this->completedReps]);
    }
}
