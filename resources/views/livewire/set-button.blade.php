<div>
    <button
        x-data="{ completedReps: @entangle('completedReps'), targetReps: {{ $set->target_reps }} }"
        class="rounded-full h-14 w-14 flex justify-around items-center flex-col shrink-0"
        :class="{
                'bg-emerald-900': targetReps === completedReps,
                'bg-emerald-500': completedReps < targetReps,
                'bg-gray-800': completedReps === null
            }"
        @click="
            if (completedReps === null) completedReps = targetReps
            else if (completedReps !== 0) completedReps--
            else if (completedReps <= 0) completedReps = null
            current = start = Date.now()
            interval = setInterval(() => {current = Date.now()}, 10)
        ">

        <span class="text-white -mt-1" x-text="completedReps ?? {{ $set->target_reps }}"></span>
        <span class="text-white text-xs -mt-6">{{ $set->weight }}kg</span>

    </button>
</div>
