<script setup>
import {Link} from '@inertiajs/inertia-vue3'

defineProps({
    page: String,
    username: String
})
</script>

<template>
    <section
        class="flex items-center border-b-[0.5px] dark:border-slate-600">
        <Link
            :href="route('followers.mutual',username)"
            class="py-4 flex-1 text-gray-500 font-bold text-center hover:bg-blue-100 dark:hover:bg-neutral-800">
            <span class="py-4" :class="page=== 'mutual-followers'? 'border-b-4 border-sky-600':''">Followers you now</span>
        </Link>
        <Link
            :href="route('followers',username)"
            class="py-4 flex-1 text-gray-500 font-bold text-center hover:bg-blue-100 dark:hover:bg-neutral-800">
            <span class="py-4" :class="page=== 'followers'? 'border-b-4 border-sky-600':''">Followers</span>
        </Link>
        <Link
            :href="route('following',username)"
            class="py-4 flex-1 text-gray-500 font-bold text-center hover:bg-blue-100 dark:hover:bg-neutral-800">
            <span class="py-4" :class="page=== 'following'? 'border-b-4 border-sky-600':''">Following</span>
        </Link>
    </section>
</template>
