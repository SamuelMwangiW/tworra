<script setup>
import Icon from '@/Components/Icons.vue'
import Rune from '@/Components/Rune.vue'
</script>

<template>
    <div class="mobile:flex items-center hidden">
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="MediaIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="GifIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="PollIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="EmojiIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="ScheduleIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
        <Rune colour="hover:bg-sky-100 dark:hover:text-sky-600 dark:hover:bg-inherit">
            <Icon name="LocationIcon" class="text-sky-500 dark:hover:text-sky-600" />
        </Rune>
    </div>
</template>
