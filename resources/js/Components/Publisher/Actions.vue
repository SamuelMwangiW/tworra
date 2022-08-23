<script setup>
import Icon from '@/Components/Icons.vue'
import Rune from '@/Components/Rune.vue'
import {
    PhotoIcon,
    GifIcon,
    ChartBarIcon,
    FaceSmileIcon,
    MapPinIcon,
} from '@heroicons/vue/24/outline'
</script>

<template>
    <div class="mobile:flex items-center hidden">
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <PhotoIcon class="text-sky-500 dark:hover:text-sky-600"/>
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <GifIcon class="text-sky-500 dark:hover:text-sky-600"/>
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <ChartBarIcon class="text-sky-500 rotate-90 dark:hover:text-sky-600"/>
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <FaceSmileIcon class="text-sky-500 dark:hover:text-sky-600"/>
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="ScheduleIcon" class="text-sky-500 dark:hover:text-sky-600"/>
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <MapPinIcon class="text-sky-500 dark:hover:text-sky-600"/>
        </Rune>
    </div>
</template>
