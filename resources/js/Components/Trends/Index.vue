<script setup>
import trends from '@/Data/trends.js'
import Trend from './Trend.vue'
</script>

<template>
    <section class="bg-slate-100 dark:bg-neutral-800 dark:border dark:border-neutral-800 py-4 rounded-2xl sticky -top-80">
        <h1 class="text-[1.25rem] font-black px-4 pb-4">Trends For You</h1>
        <div>
            <Trend v-for="trend in trends" :key="trend.id" :trend="trend" />
        </div>
    </section>
</template>
