<script setup>
import { EllipsisHorizontalIcon } from '@heroicons/vue/24/outline'

defineProps({
    trend: Object,
})
</script>

<template>
    <div class="py-4 px-4 flex items-center justify-between hover:bg-neutral-200 dark:hover:bg-neutral-900 cursor-pointer hover-transition">
        <div>
            <h5 class="text-xs tracking-tight text-neutral-500">{{ trend.category }}</h5>
            <h3 class="font-semibold text-md ">{{ trend.title }}</h3>
            <span class="text-xs tracking-tight text-neutral-500">
                {{ trend.tweetCount }} Tweets
            </span>
        </div>
        <div class="p-2 hover:bg-sky-100 ml-auto rounded-full group cursor-pointer hover-transition dark:hover:bg-neutral-800">
            <EllipsisHorizontalIcon class="w-4 h-4 text-neutral-500 group-hover:text-sky-500" />
        </div>
    </div>
</template>
