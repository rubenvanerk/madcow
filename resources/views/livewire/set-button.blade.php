<div>
    <button
        x-data="{ completedReps: @entangle('completedReps'), targetReps: {{ $set->target_reps }} }"
        class="rounded-full h-14 w-14 flex justify-around items-center flex-col shrink-0 focus:outline-none drop-shadow-line drop-shadow-line inset-y-1 -translate-y-1 transition hover:translate-x-0 hover:translate-y-0 hover:drop-shadow-none focus:translate-x-0 focus:translate-y-0 focus:drop-shadow-none"
        :class="{
                'bg-emerald-900': targetReps === completedReps,
                'bg-emerald-600': completedReps !== null && completedReps < targetReps,
                'bg-gray-800 dark:bg-gray-900': completedReps === null
            }"
        @click="
            if (completedReps === null) completedReps = targetReps
            else if (completedReps !== 0) completedReps--
            else if (completedReps <= 0) completedReps = null
            current = start = Date.now()
            interval = setInterval(() => {current = Date.now()}, 10)
            navigator.vibrate(100)
        ">

        <span class="text-white dark:text-gray-200 -mt-1 font-semibold" x-text="completedReps ?? {{ $set->target_reps }}"></span>
        <span class="text-white dark:text-gray-200 text-xs -mt-6">{{ $set->weight }}kg</span>

    </button>
</div>
