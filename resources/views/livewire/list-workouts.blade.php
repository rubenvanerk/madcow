<div>
    <x-button wire:click="generateWorkouts">Generate new workouts</x-button>

    <span wire:loading class="animate-pulse">Generating...</span>

    <div class="flex-col space-y-5 mt-5">
        @forelse($workouts as $workout)
            <x-workout-card :workout="$workout"/>
        @empty
            You have no upcoming workouts.
        @endforelse
    </div>
</div>
