<script setup>
import LayoutHeader from '@/Layouts/Twitter/Header.vue'
</script>
<template>
    <div class="grid-cols-[auto_1fr] desktop:max-w-7xl laptop:max-w-5xl max-w-2xl mx-auto">
        <LayoutHeader />
        <main class="grid grid-cols-[auto_1fr] desktop:ml-72 tablet:ml-20 min-h-screen">
            <slot />
        </main>
    </div>
</template>
