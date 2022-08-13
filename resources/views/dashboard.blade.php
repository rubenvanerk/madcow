<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  x-data="{ showPast: false }">

        <nav class="flex space-x-4 justify-around">
            <!-- Current: "bg-gray-100 text-gray-700", Default: "text-gray-500 hover:text-gray-700" -->
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
