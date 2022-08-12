<div>
    @php
        $workout->refresh();
        $exercises = $workout->sets->groupBy('exercise')
    @endphp

    <div x-data="{
        start: null,
        current: null,
        interval: null
    }">

        <div class="mb-4">
            <x-label>Current rest:</x-label>
            <span x-text="String(Math.floor((current - start) / 1000 / 60)).padStart(2, '0')"></span> :
            <span x-text="(String(Math.round((current - start) / 1000) % 60)).padStart(2, '0')"></span>
        </div>

        @foreach($exercises as $exerciseSet)
            @php
                $exercise = $exerciseSet->first()->exercise
            @endphp
            <h2>{{ $exercise }}</h2>

            <div class="flex space-x-3 overflow-scroll">
                @foreach($exerciseSet as $set)
                    <button x-transition
                            class="@if($set->target_reps === $set->completed_reps) bg-emerald-900 @elseif($set->completed_reps !== null) bg-emerald-500 @else bg-gray-800 @endif rounded-full h-14 w-14 flex justify-around items-center flex-col shrink-0"
                            wire:click="updateCompletedReps({{ $set }})"
                            @click="
                                start = Date.now()
                                current = start
                                interval = setInterval(() => {current = Date.now()}, 10)
                            "
                    >
                        <span class="text-white -mt-1">{{ $set->completed_reps ?? $set->target_reps }}</span>
                        <span class="text-white text-xs -mt-6">{{ $set->weight }}kg</span>
                    </button>
                @endforeach
            </div>
        @endforeach

    </div>

    @if($workout->completed_at === null)
        <x-button wire:click="toggleCompletedAt" class="mt-8">Finish</x-button>
    @else
        <x-button wire:click="toggleCompletedAt" class="mt-8">Unfinish</x-button>
    @endif

    @if($workout->completed_at !== null)
        <div class="mt-5">
            <x-label>Completed at</x-label>
            <span>{{ $workout->completed_at->isoFormat('LLL') }}</span>
        </div>
    @endif
</div>
