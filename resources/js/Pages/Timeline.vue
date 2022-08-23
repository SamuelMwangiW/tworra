<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline'
import TwitterLayout from '@/Layouts/Twitter/Index.vue'
import Publisher from '@/Components/Publisher/Index.vue'
import Feed from '@/Components/Feed/Index.vue'
import Trends from '@/Components/Trends/Index.vue'

defineProps({
    tweets: Object,
});
</script>

<template>
    <Head title="Welcome" ></Head>

    <TwitterLayout>
        <div class="max-w-[37.5rem] md:min-w-[37.5rem] border-x-[0.5px] dark:border-neutral-600">
            <section class="sticky top-0 px-4 py-2 bg-white dark:bg-neutral-900">
                <h1 class="text-lg font-bold">Home</h1>
            </section>
            <Publisher />
            <Feed :tweets="tweets"/>
        </div>
        <div class="laptop:block hidden px-8 space-y-1">
            <section class="sticky top-0 py-3 bg-white dark:bg-neutral-900 z-20">
                <div class="flex items-center gap-4 px-4 py-2 bg-neutral-100 dark:bg-neutral-800 focus-within:bg-neutral-50 dark:focus-within:bg-neutral-800 group focus-within:ring-1 ring-sky-500 rounded-full">
                    <MagnifyingGlassIcon class="w-5 h-5 text-neutral-500 dark:text-neutral-200 group-focus-within:text-sky-500" />
                    <input
                        type="text"
                        placeholder="Search Twitter"
                        class="text-base p-0 placeholder:text-base border-none focus:ring-0 focus:outline-none bg-transparent"
                    />
                </div>
            </section>
            <Trends />
        </div>
    </TwitterLayout>
</template>
