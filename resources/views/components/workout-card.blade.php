@props(['workout'])

@php
    $exercises = $workout->sets->groupBy('exercise');
@endphp

<div {{ $attributes }}>

    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-medium mb-2 text-gray-900">{{ \Carbon\Carbon::getDays()[$workout->day] }}</h2>
        <span class="text-sm text-gray-600">{{ $workout->completed_at?->isoFormat('LLL') }}</span>
    </div>

    <div class="flex-col space-y-5">
        @foreach($exercises as $exerciseSets)
            @php
                $exercise = \App\Enums\Exercise::from($exerciseSets->first()->exercise);
            @endphp

            <div class="px-4 bg-white shadow rounded-lg overflow-hidden">
                <h2 class="ml-1 text-lg leading-6 font-semibold text-gray-900 py-3">{{ $exercise->name() }}</h2>
                <div class="flex space-x-3 overflow-scroll md:overflow-auto pb-5">
                    @foreach($exerciseSets as $set)
                        <span class="rounded-full h-12 w-12 flex justify-around items-center flex-col shrink-0
                        @if($set->completed_reps === $set->target_reps) bg-emerald-900 @endif
                        @if($set->completed_reps !== null && $set->completed_reps < $set->target_reps) bg-emerald-600 @endif
                        @if($set->completed_reps === null) bg-gray-800 @endif">
                            <span class="text-white text-xs -mt-0.5 font-semibold">{{ $set->completed_reps === null ? $set->target_reps : $set->completed_reps }}</span>
                            <span class="text-white text-xs -mt-6">{{ $set->weight }}kg</span>
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
