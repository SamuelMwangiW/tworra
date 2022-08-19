<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import FollowingHeader from './Header.vue'
import Avatar from '@/Components/Avatar.vue'

defineProps({
    user: Object,
    users: Object,
    page: {type: String, default: 'following'},
})
</script>

<template>
    <following-header :page="page" :username="user.data.username"/>
    <div class="">
        <div class="flex py-2 items-center hover:bg-neutral-200 dark:hover:bg-neutral-800" v-for="tweep in users.data" :key="tweep.id">
            <div class="shrink-0 p-4">
                <Avatar :src="tweep.profilePhotoUrl" />
            </div>
            <div class="flex-grow flex flex-col">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        <div class="text-base font-semibold">{{ tweep.name }}</div>
                        <div class="text-sm leading-none text-neutral-500">@{{ tweep.username }}</div>
                    </div>
                    <div class="pr-3">
                        <Link
                            :href="route('follow.destroy',tweep.username)"
                            method="DELETE"
                            v-if="tweep.following"
                            class="px-4 py-2 rounded-full border border-gray-500 hover:bg-rose-500 dark:hover:bg-neutral-600">
                            Unfollow
                        </Link>
                        <Link
                            :href="route('follow.create',tweep.username)"
                            method="POST"
                            v-if="!tweep.following"
                            class="px-4 py-2 rounded-full border border-gray-500 hover:bg-rose-500 dark:hover:bg-neutral-600">
                            Follow
                        </Link>
                    </div>
                </div>
                <div class="pt-2">
                    {{ tweep.description }}
                </div>
            </div>
        </div>
        <div v-if="!users.data.length" class="py-4 flex items-center justify-center font-semibold text-lg">
            <p>It's Kinda lonely in here</p>
        </div>
    </div>
</template>
