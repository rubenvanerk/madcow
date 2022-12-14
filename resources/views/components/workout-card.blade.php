@props(['workout'])

@php
    $exercises = $workout->sets->groupBy('exercise');
@endphp

<div {{ $attributes }}>

    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-medium mb-2 text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::getDays()[$workout->day] }}</h2>
        @if ($workout->completed_at !== null)
            <x-carbon :date="$workout->completed_at" local="LLL" class="text-sm text-gray-600 dark:text-gray-400"/>
        @endif
    </div>

    <div class="flex-col space-y-5">
        @foreach($exercises as $exerciseSets)
            @php
                $exercise = \App\Enums\Exercise::from($exerciseSets->first()->exercise);
            @endphp

            <div class="px-4 bg-white shadow rounded-lg overflow-hidden dark:bg-gray-800">
                <h2 class="ml-1 text-lg leading-6 font-semibold text-gray-900 py-3 dark:text-gray-200">{{ $exercise->name() }}</h2>
                <div class="flex space-x-3 overflow-scroll md:overflow-auto pb-5">
                    @foreach($exerciseSets as $set)
                        <span class="rounded-full h-12 w-12 flex justify-around items-center flex-col shrink-0 shadow
                        @if($set->completed_reps === $set->target_reps) bg-emerald-900 @endif
                        @if($set->completed_reps !== null && $set->completed_reps < $set->target_reps) bg-emerald-600 @endif
                        @if($set->completed_reps === null) bg-gray-800 dark:bg-gray-900 @endif">
                            <span class="text-white dark:text-gray-200 text-xs -mt-0.5 font-semibold">{{ $set->completed_reps === null ? $set->target_reps : $set->completed_reps }}</span>
                            <span class="text-white dark:text-gray-200 text-xs -mt-6">{{ $set->weight }}kg</span>
                        </span>
                    @endforeach
                </div>
            </div>

        @endforeach
    </div>

    <div class="flex justify-end mt-3">
        <x-button href="{{ route('workout', [$workout]) }}">
            {{ $workout->completed_at === null ? 'Start' : 'View' }}
        </x-button>
    </div>
</div>
