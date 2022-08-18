<script setup>
import {Link} from '@inertiajs/inertia-vue3'

defineProps({
    name: {type: String, required: true},
    active: {type: Boolean, required: true},
    icon: {required: true},
    href: {type: String, default: '#'},
    post: {type: Boolean, default: false},
})
</script>

<template>
    <Link v-if="post" :href="href" class="flex group" as="button" method="POST">
        <div
            class="flex gap-4 items-center group-hover:bg-slate-200 dark:group-hover:bg-slate-800 desktop:px-4 px-3 py-3 rounded-full hover-transition">
            <Component :is="icon" class="w-6 h-6"/>
            <span :class="active ? 'font-bold':''" class="text-[1.25rem] hidden desktop:block">
                {{ name }}
            </span>
        </div>
    </Link>
    <Link v-else :href="href" class="flex group">
        <div
            class="flex gap-4 items-center group-hover:bg-slate-200 dark:group-hover:bg-slate-800 desktop:px-4 px-3 py-3 rounded-full hover-transition">
            <Component :is="icon" class="w-6 h-6"/>
            <span :class="active ? 'font-bold':''" class="text-[1.25rem] hidden desktop:block">
                {{ name }}
            </span>
        </div>
    </Link>
</template>
