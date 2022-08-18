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
                src="https://images.unsplash.com/photo-1614639437280-558b05b13939?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHx0b3BpYy1mZWVkfDM0fHRvd0paRnNrcEdnfHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
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
