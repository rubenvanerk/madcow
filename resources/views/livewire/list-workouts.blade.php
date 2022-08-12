<div>
    <div class="flex-col space-y-5">

        @if(auth()->user()->rep_maxes->isNotEmpty())
            <x-button
                wire:click="generateWorkouts"
                onclick="confirm('Workouts that are not completed will be deleted! New workouts will be generated based on your 1 RMs. Are you sure?' || event.stopImmediatePropagation())">Generate new workouts</x-button>

            <span wire:loading class="animate-pulse">Generating...</span>
        @endif

        @forelse($workouts as $workout)
            <x-workout-card :workout="$workout" wire:loading.remove/>
        @empty
            You have no upcoming workouts.
        @endforelse
    </div>
</div>
