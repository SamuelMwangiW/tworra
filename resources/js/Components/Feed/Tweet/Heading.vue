<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import {EllipsisHorizontalIcon} from '@heroicons/vue/24/solid'

defineProps({
    name: String,
    username: String,
    time: String,
})
</script>

<template>
    <div class="flex gap-1 items-center">
        <Link :href="route('show-user-profile',{user:username})" class="font-bold hover:underline">
            {{ name }}
        </Link>
        <Link :href="route('show-user-profile',{user:username})" class="text-neutral-500 hidden mobile:block">
            @{{ username }}
        </Link>
        <span class="text-neutral-500">•</span>
        <h2 class="text-neutral-500">{{ time }}</h2>
        <div
            class="p-2 hover:bg-sky-100 ml-auto rounded-full group cursor-pointer transition-colors duration-500 ease-out">
            <EllipsisHorizontalIcon class="w-4 h-4 text-neutral-400 group-hover:text-sky-500"/>
        </div>
    </div>
</template>
