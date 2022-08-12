@props(['workout'])

@php
    $exercises = $workout->sets->groupBy('exercise');
@endphp

<div {{ $attributes }}>

    <h2 class="text-2xl font-medium mb-2">{{ \Carbon\Carbon::getDays()[$workout->day] }}</h2>

    <div class="flex-col space-y-5">
        @foreach($exercises as $exerciseSets)
            @php
                $exercise = \App\Enums\Exercise::from($exerciseSets->first()->exercise);
            @endphp

            <div class="px-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <h2 class="ml-1 text-lg leading-6 font-semibold text-gray-900 py-3">{{ $exercise->name() }}</h2>
                <div class="flex space-x-3 overflow-scroll pb-5">
                    @foreach($exerciseSets as $set)
                        <span
                            class="rounded-full h-12 w-12 flex justify-around items-center flex-col shrink-0 bg-gray-900">
                            <span class="text-white text-xs -mt-0.5 font-semibold">{{ $set->target_reps }}</span>
                            <span class="text-white text-xs -mt-6">{{ $set->weight }}kg</span>
                        </span>
                    @endforeach
                </div>
            </div>

        @endforeach
    </div>

    <div class="flex justify-end mt-3">
        <x-button href="{{ route('workout', [$workout]) }}">
            Start
        </x-button>
    </div>
</div>
