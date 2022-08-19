<script setup>
import {DotsHorizontalIcon} from '@heroicons/vue/solid'
import Avatar from '@/Components/Avatar.vue'
import {usePage} from '@inertiajs/inertia-vue3'

const user = usePage().props.value.auth.user
</script>

<template>
    <div
        class="flex items-center justify-between desktop:w-[17rem] hover:bg-slate-200 dark:hover:bg-slate-800 desktop:px-4 px-3 py-3 rounded-full hover-transition cursor-pointer">
        <div class="flex items-center gap-2">
            <Avatar
                :src="user.profile_photo_url"
                alt="Profile"
                width-class="w-10"
                height-class="h-10"
            />
            <div class='desktop:block hidden'>
                <h1 class="font-semibold text-md">{{ user.name }}</h1>
                <h2 class="text-neutral-500 -mt-1">@{{ user.username }}</h2>
            </div>
        </div>
        <DotsHorizontalIcon class="w-4 h-4 text-neutral-500 desktop:block hidden"/>
    </div>
</template>
