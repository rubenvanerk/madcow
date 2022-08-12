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

        @foreach($setsByExercise as $exercise => $sets)
            <h2>{{ $exercise }}</h2>

            <div class="flex space-x-3 overflow-scroll">
                @foreach($sets as $set)
                    <livewire:set-button :set="$set"/>
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
