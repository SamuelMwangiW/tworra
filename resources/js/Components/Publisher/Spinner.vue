<script setup>
import 'vue3-circle-progress/dist/circle-progress.css'
import CircleProgress from 'vue3-circle-progress'
import {computed} from 'vue'

const props = defineProps({
    percent: Number
});

const fillColour = computed(()=>{
    if (props.percent < 50) return '#288feb';
    if (props.percent < 75) return '#FBBF24';
    return '#B91C1C';
})

</script>

<template>
    <span>
        <circle-progress
            empty-color="#f7f7f7"
            :fill-color="fillColour"
            :border-width="4"
            :border-bg-width="4"
            :percent="percent"
            :size="24"
        />
    </span>
</template>
