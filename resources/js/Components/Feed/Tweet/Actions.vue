<script setup>
import {Link} from '@inertiajs/vue3'
import Rune from '@/Components/Rune.vue'
import {ChatBubbleLeftIcon, ArrowPathIcon, HeartIcon, ArrowUpTrayIcon} from '@heroicons/vue/24/outline'

defineProps({
    tweetId: Number,
    replies: Number,
    retweets: Number,
    likes: Number,
    liked: Boolean,
    retweeted: Boolean,
})
</script>

<template>
    <div class="flex justify-between mt-3 max-w-md cursor-pointer">
        <div class="flex items-center group tablet:pr-4">
            <Rune colour="group-hover:bg-sky-100 dark:group-hover:bg-inherit">
                <ChatBubbleLeftIcon class="group-hover:text-sky-500"/>
            </Rune>
            <p v-if="replies" class="text-xs group-hover:text-sky-500">{{ replies }}</p>
        </div>
        <Link
            :href="route('tweet.retweet',tweetId)"
            method="post"
            as="button"
            preserve-scroll
            class="flex items-center group tablet:px-4">
            <Rune colour="group-hover:bg-green-100 dark:group-hover:bg-inherit">
                <ArrowPathIcon class="group-hover:text-green-500" :class="retweeted ? 'text-green-500':''"/>
            </Rune>
            <p
                v-if="retweets"
                class="text-xs group-hover:text-green-500"
                :class="retweeted ? 'text-green-500':''"
            >
                {{ retweets }}
            </p>
        </Link>
        <Link
            :href="route('tweet.like',tweetId)"
            method="post"
            as="button"
            preserve-scroll
            class="flex items-center group tablet:px-4">
            <Rune colour="group-hover:bg-rose-100 dark:group-hover:bg-inherit">
                <HeartIcon class="group-hover:text-rose-500" :class="liked ? 'text-rose-500':''"/>
            </Rune>
            <p
                v-if="likes"
                class="text-xs group-hover:text-rose-500"
                :class="liked ? 'text-rose-500':''"
            >{{likes }}</p>
        </Link>
        <div class="flex items-center group tablet:pl-4">
            <Rune colour="group-hover:bg-sky-100 dark:group-hover:bg-inherit">
                <ArrowUpTrayIcon class="group-hover:text-sky-500"/>
            </Rune>
        </div>
    </div>
</template>
