<x-app-layout>

    <div x-data="{ showPast: false }">

        <nav class="flex space-x-4 justify-around">
            <a href="#" class="px-3 py-2 font-semibold text-sm rounded-md transition"
               x-on:click.prevent="showPast = false"
               :class="{ 'bg-gray-200 text-gray-800': !showPast, 'text-gray-600 hover:text-gray-800s': showPast }">
                Future
            </a>

            <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 font-medium text-sm rounded-md transition"
               x-on:click.prevent="showPast = true"
               :class="{ 'bg-gray-200 text-gray-800': showPast, 'text-gray-600 hover:text-gray-800s': !showPast }">
                Past
            </a>
        </nav>

        <livewire:list-workouts x-show="!showPast"/>
        <livewire:list-workouts :past="true"/>
    </div>

</x-app-layout>
