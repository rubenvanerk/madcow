<div>
    <x-slot name="header">
        One rep maxes
    </x-slot>

    <form wire:submit.prevent="save">

        <div class="flex-col space-y-5 mt-5">
            @foreach($user->rep_maxes as $repMax)
                <div>
                    <x-label for="{{ $repMax->exercise->value }}">{{ $repMax->exercise->name() }}</x-label>

                    <div class="flex space-x-5 mt-1">
                        <div class="w-full">
                            <x-input id="{[ $repMax->exercise->value }}" class="block w-full" type="number" required
                                     min="1"
                                     autocomplete="off"
                                     wire:model="user.rep_maxes.{{ $repMax->exercise->value }}.weight"
                            />

                            <div class="text-sm text-gray-700 mt-1">1RM: {{ $repMax->getOneRepMax() }}</div>
                        </div>

                        <select wire:model="user.rep_maxes.{{ $repMax->exercise->value }}.reps"
                                class="pl-3 pr-10 h-10 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                            @foreach(range(1, 10) as $reps)
                                <option>{{ $reps }}</option>
                            @endforeach
                        </select>

                        @php
                            $exercise = $repMax->exercise->value
                        @endphp
                    </div>
                </div>
            @endforeach

            @foreach($errors as $error)
                {{ $error }}
            @endforeach

            <x-button wire:loading.attr="disabled" wire:target="submit" wire:click="save">
                Save
            </x-button>
        </div>
    </form>
</div>
