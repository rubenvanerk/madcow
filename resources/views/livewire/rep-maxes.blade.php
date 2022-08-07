<div>
    <x-slot name="header">
        One rep maxes
    </x-slot>

    <form wire:submit.prevent="save">

        <div class="flex-col space-y-5 mt-5">
            @foreach($user->rep_maxes as $repMax)
                <div>
                    <x-label
                        for="{{ $repMax->exercise->value }}">{{ str($repMax->exercise->value)->headline()->lower()->ucfirst() }}</x-label>

                    <div class="flex space-x-5">
                        <div class="w-full">
                            <x-input id="{ $repMax->exercise->value }}" class="block mt-1 w-full" type="number" required
                                     autofocus
                                     wire:model="user.rep_maxes.{{ $repMax->exercise->value }}.weight"
                            />

                            <span>1RM: {{ $repMax->getOneRepMax() }}</span>
                        </div>

                        <select wire:model="user.rep_maxes.{{ $repMax->exercise->value }}.reps">
                            @foreach(range(1, 10) as $reps)
                                <option>{{ $reps }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach

            <x-button>Save</x-button>
        </div>
    </form>
</div>
