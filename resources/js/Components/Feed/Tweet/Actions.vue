<script setup>

import Rune from '@/Components/Rune.vue'
import Icon from '@/Components/Icons.vue'

defineProps({
    replies: Number,
    retweets: Number,
    likes: Number
})
</script>

<template>
    <div class="flex justify-between mt-3 max-w-md cursor-pointer">
        <div class="flex items-center group tablet:pr-4">
            <Rune colour="group-hover:bg-sky-100 dark:group-hover:bg-inherit">
                <Icon name="ReplyIcon" class="group-hover:text-sky-500" />
            </Rune>
            <p class="text-xs group-hover:text-sky-500">{{ replies }}</p>
        </div>
        <div class="flex items-center group tablet:px-4">
            <Rune colour="group-hover:bg-green-100 dark:group-hover:bg-inherit">
                <Icon name="RetweetIcon" class="group-hover:text-green-500" />
            </Rune>
            <p class="text-xs group-hover:text-green-500">{{ retweets }}</p>
        </div>
        <div class="flex items-center group tablet:px-4">
            <Rune colour="group-hover:bg-rose-100 dark:group-hover:bg-inherit">
                <Icon name="LikeIcon" class="group-hover:text-rose-500" />
            </Rune>
            <p class="text-xs group-hover:text-rose-500">{{ likes }}</p>
        </div>
        <div class="flex items-center group tablet:pl-4">
            <Rune colour="group-hover:bg-sky-100 dark:group-hover:bg-inherit">
                <Icon name="ShareIcon" class="group-hover:text-sky-500" />
            </Rune>
        </div>
    </div>
</template>
