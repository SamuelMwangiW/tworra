<script setup>
import {DotsHorizontalIcon} from '@heroicons/vue/outline'

defineProps({
    name: String,
    username: String,
    time: String,
})
</script>

<template>
    <div class="flex gap-1 items-center">
        <h1 class="font-bold">{{ name }}</h1>
        <h2 class="text-neutral-500 hidden mobile:block">@{{ username }}</h2>
        <span class="text-neutral-500">•</span>
        <h2 class="text-neutral-500">{{ time }}</h2>
        <div
            class="p-2 hover:bg-sky-100 ml-auto rounded-full group cursor-pointer transition-colors duration-500 ease-out">
            <DotsHorizontalIcon class="w-4 h-4 text-neutral-400 group-hover:text-sky-500"/>
        </div>
    </div>
</template>
