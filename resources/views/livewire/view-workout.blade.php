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

        @if ($workout->completed_at === null)
            <div class="mb-4 ml-2">
                <x-label>Current rest:</x-label>
                <span x-text="String(Math.floor((current - start) / 1000 / 60)).padStart(2, '0')"></span> :
                <span x-text="(String(Math.round((current - start) / 1000) % 60)).padStart(2, '0')"></span>
            </div>
        @endif

        <div class="flex-col space-y-5">
            @foreach($setsByExercise as $exercise => $sets)
                <div class="px-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                    <h2 class="ml-1 text-lg leading-6 font-semibold text-gray-900 py-3">{{ \App\Enums\Exercise::from($exercise)->name() }}</h2>

                    <div class="flex space-x-3 overflow-scroll pb-5">
                        @foreach($sets as $set)
                            <livewire:set-button :set="$set" :wire:key="$set->id"/>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

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
