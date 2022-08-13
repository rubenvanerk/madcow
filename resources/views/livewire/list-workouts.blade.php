<div x-show="{{ $past ? 'showPast' : '!showPast'  }}">
    <div class="flex-col space-y-5 mt-6">
        @forelse($workouts as $workout)
            <x-workout-card :workout="$workout"/>
        @empty
            <div class="w-full flex justify-center">

                @if (!$past)
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <button type="button" class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" wire:loading.class="animate-spin">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="mt-2 block text-sm font-medium text-gray-900" wire:click="generateWorkouts">
                            <span wire:loading>Generating workouts...</span>
                            <span wire:loading.remove>Click here to generate workouts</span>
                        </span>
                    </button>

                @else
                    You have no completed workouts.
                @endif

            </div>
        @endforelse
    </div>
</div>
