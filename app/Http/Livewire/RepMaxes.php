<?php

namespace App\Http\Livewire;

use App\Enums\Exercise;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

class RepMaxes extends Component
{
    public User $user;

    public function mount(Request $request): void
    {
        if (is_null($request->user())) {
            $this->redirectRoute('welcome');

            return;
        }

        $this->user = $request->user();
    }

    public function render(): View
    {
        return view('livewire.rep-maxes');
    }

    /**
     * @return Collection<string, array{0: string, 1: string, 2?: string}>
     */
    public function rules(): Collection
    {
        return collect(Exercise::cases())
            ->mapWithKeys(fn (Exercise $exercise) => [
                'user.rep_maxes.'.$exercise->value.'.weight' => ['number', 'min:1'],
                'user.rep_maxes.'.$exercise->value.'.reps' => ['number', 'min:1', 'max:10'],
            ]);
    }

    public function save(): void
    {
        $this->user->save();
    }
}
