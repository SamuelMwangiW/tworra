<script setup>
defineProps({
    colour: {required: true, type: String}
})
</script>

<template>
    <div :class="colour" class="w-9 h-9 p-2 rounded-full hover-transition cursor-pointer">
        <slot/>
    </div>
</template>
