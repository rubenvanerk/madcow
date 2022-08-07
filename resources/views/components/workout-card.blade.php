@props(['workout'])

@php
    $exercises = $workout->sets->groupBy('exercise');
@endphp

<div {{ $attributes->class('flex-col divide-y-2') }}>

    <h2 class="text-2xl">{{ \Carbon\Carbon::getDays()[$workout->day] }}</h2>

    @foreach($exercises as $exerciseSets)
        @php
            $exercise = $exerciseSets->first()->exercise;
        @endphp

        <div>
            <h3>{{ $exercise }}</h3>
            <ul>
                @foreach($exerciseSets as $set)
                    <li>{{ $set->target_reps }} x {{ $set->weight }}</li>
                @endforeach
            </ul>
        </div>

    @endforeach

    <a href="{{ route('workout', [$workout]) }}" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Start
    </a>
</div>
