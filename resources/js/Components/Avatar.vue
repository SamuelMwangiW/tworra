<script setup>

defineProps({
    src: String,
    alt: String,
    widthClass: {
        type: String,
        default: 'w-12',
    },
    heightClass: {
        type: String,
        default: 'h-12',
    }
})
</script>

<template>
    <div class="overflow-hidden rounded-full" :class="`${widthClass} ${heightClass}`">
        <img :src="src" :alt="alt" class="w-full" />
    </div>
</template>
